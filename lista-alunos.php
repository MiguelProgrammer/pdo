<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

try {

    $pdo = new PDO('sqlite:' . __DIR__ . ' ./banco2sqlite');
    $statement = $pdo->query( 'SELECT * FROM students');

    while($resultSet = $statement->fetch(PDO::FETCH_ASSOC)){
        echo $resultSet["id"]." - ".$resultSet["name"];
        $alunos[] = new Student($resultSet["id"],$resultSet["name"], new DateTimeImmutable($resultSet["birth_date"]));
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

