<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

try {

    $pdo = new PDO('sqlite:' . __DIR__ . ' ./banco2sqlite');
    $student = new Student(null,"Jéssica Silva", new DateTimeImmutable('1990-01-08'));
    $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";

    $message = "Erro ao executar instrução!".PHP_EOL;
    $statement = $pdo->prepare($sqlInsert);

    $statement->bindValue("name",$student->name());
    $statement->bindValue("birth_date",$student->birthDate()->format("Y-m-d"));

    if($statement->execute()){
        $message = "Executado com sucesso!".PHP_EOL;
    }

    echo $message;

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

