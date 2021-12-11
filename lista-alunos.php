<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

try {

    $pdo = ConnectionCreator::createConnection();
    $statement = $pdo->query( 'SELECT * FROM students');

    while($resultSet = $statement->fetch(PDO::FETCH_ASSOC)){
        echo $resultSet["id"]." - ".$resultSet["name"]." - ".$resultSet["birth_date"].PHP_EOL;
        $alunos[] = new Student($resultSet["id"],$resultSet["name"], new DateTimeImmutable($resultSet["birth_date"]));
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

