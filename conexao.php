<?php

try {

    $pdo = new PDO('sqlite:' . __DIR__ . './banco.sqlite');

    $pdo->exec("CREATE TABLE students
                            (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);
                          CREATE TABLE IF NOT EXISTS 
                            phones (id INTEGER PRIMARY KEY, area_code TEXT, number TEXT, student_id INTEGER,
                            FOREIGN KEY (student_id) REFERENCES students (id));");

    //INSERT INTO phones (area_code, number, student_id) VALUES ('11','91111-2222',1), ('11', '92222-3333',6);

} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}
