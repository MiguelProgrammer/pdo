<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;

class PDOStudentRepository implements StudentRepository
{

    public function allStudents(): array
    {
        // TODO: Implement allStudents() method.
    }

    public function studentsForBirthDay(\DateTimeImmutable $birthDay): array
    {
        // TODO: Implement studentsForBirthDay() method.
    }

    public function save(Student $student): bool
    {
        // TODO: Implement save() method.
    }

    public function remove(Student $student): bool
    {
        // TODO: Implement remove() method.
    }
}