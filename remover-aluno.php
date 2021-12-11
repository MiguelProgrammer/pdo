<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

try {

    $pdo = new PDO('sqlite:' . __DIR__ . ' ./banco2sqlite');
    $statement = $pdo->query( 'DELETE FROM students WHERE id = ?');
    $statement->bindValue(1,2,PDO::PARAM_INT);

    if($statement->execute()){
        echo "Executado com sucesso!";
    }

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

