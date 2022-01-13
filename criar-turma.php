<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PDOStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PDOStudentRepository($connection);
$connection->beginTransaction();

try {

    $student0ne = new Student(null, 'Fbio Nunes', new DateTimeImmutable('1822-04-11'));
    $studentRepository->save($student0ne);
    $studentTwo = new Student(null, 'Sula Nunes', new DateTimeImmutable('1966-04-11'));
    $studentRepository->save($studentTwo);
    $connection->commit();

} catch (PDOException $e){
    echo $e->getMessage();
    $connection->rollBack();
}



