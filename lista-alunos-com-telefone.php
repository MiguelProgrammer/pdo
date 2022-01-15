<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PDOStudentRepository;

require_once 'vendor/autoload.php';

try {

    $pdo = ConnectionCreator::createConnection();
    $repository = new PDOStudentRepository($pdo);

    $returnData = $repository->allStudentsWithPhones();

    foreach ($returnData as $info) {
        var_dump($info);
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

