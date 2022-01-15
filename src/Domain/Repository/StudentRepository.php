<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function allStudentsWithPhones(): array;
    public function studentsForBirthDay(\DateTimeImmutable $birthDay): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;


}