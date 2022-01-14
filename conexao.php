<?php

try {

    $pdo = new PDO('sqlite:' . __DIR__ . './banco.sqlite');
    $pdo->exec('CREATE TABLE students 
                            (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);
                          CREATE TABLE IF NOT EXISTS 
                            phones (id INTEGER PRIMARY KEY, area_code TEXT, number TEXT, student_id INTEGER,
                            FOREIGN KEY (student_id) REFERENCES students (id));');

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}

