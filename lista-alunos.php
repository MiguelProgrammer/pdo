<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

try {

    $pdo = new PDO('sqlite:' . __DIR__ . ' ./banco2sqlite');
    $statement = $pdo->query( 'SELECT * FROM students');
    $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

    for($i = 0; $i < count($resultSet); $i++){
        echo $resultSet[$i]["id"]." - ".$resultSet[$i]["name"];
        $alunos[] = new Student($resultSet[$i]["id"],$resultSet[$i]["name"], new DateTimeImmutable($resultSet[$i]["birth_date"]));
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

