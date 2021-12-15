<?php

namespace Alura\Pdo\Infrastructure\Repository;

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
        $this->connection->query("SELECT * FROM students");
        return $this->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listStudents(PDOStatement $stmt): array
    {
        $listStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listStudentsArray = [];
        foreach ($listStudents as $id => $student){
            $listStudentsArray[] = new Student($id,$student["name"],new \DateTimeImmutable($student["birthDate"]));
        }
        return $listStudentsArray;
    }

    public function studentsForBirthDay(\DateTimeImmutable $birthDay): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM students WHERE birth_date = :birthDate");
        $stmt->bindValue(":birthDate", $birthDay->format("Y-m-d"));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        $stmt = $this->connection->prepare("INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)");;
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
}