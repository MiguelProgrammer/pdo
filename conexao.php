<?php

try {

    $pdo = new PDO('sqlite:' . __DIR__ . './banco.sqlite');
    $pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);');

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

