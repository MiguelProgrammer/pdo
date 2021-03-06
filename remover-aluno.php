<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

try {

    $pdo = ConnectionCreator::createConnection();
    $statement = $pdo->prepare( 'DELETE FROM students WHERE id = ?');
    $statement->bindValue(1,5,PDO::PARAM_INT);

    if($statement->execute()){
        echo "Executado com sucesso!";
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

