<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

try {

    $pdo = new PDO('sqlite:' . __DIR__ . ' ./banco2sqlite');
    $statement = $pdo->query( 'SELECT * FROM students');
    $resultSet = $statement->fetchAll();

    for($i = 0; $i < count($resultSet); $i++){
        echo PHP_EOL.$resultSet[$i]["name"]." - ".$resultSet[$i]["birth_date"].PHP_EOL;
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

