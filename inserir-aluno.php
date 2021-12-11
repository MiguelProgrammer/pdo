<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

try {

    $pdo = new PDO('sqlite:' . __DIR__ . ' ./banco2sqlite');
    $student = new Student(null,"Miguel Silva", new DateTimeImmutable('1989-04-11'));
    $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?,?);";

    $message = "Erro ao executar instrução!".PHP_EOL;
    $statement = $pdo->prepare($sqlInsert);

    $statement->bindValue(1,$student->name());
    $statement->bindValue(2,$student->birthDate()->format("Y-m-d"));

    if($statement->execute()){
        $message = "Executado com sucesso!".PHP_EOL;
    }

    echo $message;

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

