<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Miguel Pereira da Silva',
    new \DateTimeImmutable('1989-04-11')
);

echo $student->age();
