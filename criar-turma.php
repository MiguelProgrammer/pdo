<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PDOStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentyRepository = new PDOStudentRepository($connection);

$connection->beginTransaction();

$studentyTwo = new Student(null, 'Sula Nunes', new DateTimeImmutable('1989-04-11'),);
$studentyRepository->save($studentyTwo);
$studenty0ne = new Student(null, 'Fábio Nunes', new DateTimeImmutable('1982-04-11'),);
$studentyRepository->save($studenty0ne);

$connection->rollBack();

