<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;
use PDOStatement;

class PDOStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $stmt = $this->connection->query("SELECT * FROM students");
        return $stmt->fetchAll(); //$this->listStudents($stmt);
    }

    public function listStudents(PDOStatement $stmt): array
    {
        $listStudents = $stmt->fetchAll();
        $listStudentsArray = [];
        foreach ($listStudents as $id => $student){
            $listStudentsArray[] = $aStudent = new Student($id, $student["name"], new \DateTimeImmutable($student["birth_date"]));
            $this->fillPhoneOf($aStudent);
        }
        return $listStudentsArray;
    }

    public function studentsForBirthDay(\DateTimeImmutable $birthDay): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM students WHERE birth_date = :birthDate");
        $stmt->bindValue(":birthDate", $birthDay->format("Y-m-d"));
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function save(Student $student): bool
    {
        if($student->id() === null){
            return $this->insert($student);
        }
        return $this->update($student);
    }

    public function insert(Student $student): bool
    {
        $stmt = $this->connection->prepare("INSERT INTO students (name, birth_date) VALUES (:name, :birthDate)");

        $success = $stmt->execute([
            "name" => $student->name(),
            ":birthDate" => $student->birthDate()->format("Y-m-d")
        ]);
        $student->definedId($this->connection->lastInsertId());
        return $success;
    }

    public function update(Student $student): bool
    {
        $stmt = $this->connection->prepare(
            "UPDATE students SET name = :name, birth_date = :birthDate WHERE id = :id");;
        $stmt->bindValue(":id", $student->id(), PDO::PARAM_INT);
        $stmt->bindValue(":name", $student->name());
        $stmt->bindValue(":birthDate", $student->birthDate()->format("Y-m-d"));
        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function allStudentsWithPhones(): array
    {
        $sqlQuery = "SELECT
                        students.id, students.name, students.birth_date
                        ,phones.id AS phone_id, phones.area_code, phones.number
                    FROM
                        students
                    JOIN
                        phones ON students.id = phones.student_id";

        $stmt = $this->connection->query($sqlQuery);
        $result = $stmt->fetchAll();
        $listStudentsArray = [];

        foreach ($result as $row){
            if(!array_key_exists($row["id"],$listStudentsArray)){
                $listStudentsArray[$row["id"]] = new Student(
                    $row["id"],
                    $row["name"],
                    new \DateTimeImmutable($row["birth_date"]));
            }

            $phone = new Phone($row["phone_id"],$row["area_code"], $row["number"]);
            $listStudentsArray[$row["id"]]->addPhone($phone);
        }

        return $listStudentsArray;
    }
    /*
    private function fillPhoneOf(Student $aStudent): void
    {
        $sqlQuery = "SELECT id, area_code, number FROM phones WHERE student_id = ?";
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $aStudent->id(), PDO::PARAM_INT);
        $stmt->execute();

        $listPhones = $stmt->fetchAll();
        foreach ($listPhones as $phone){
            $phone = new Phone($phone["id"], $phone["area_code"], $phone["number"]);
            $aStudent->addPhone($phone);
        }

    }
    */
}