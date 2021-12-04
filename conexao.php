<?php

try {
    $pdo = new PDO('sqlite:banco.sqlite');
    
} catch (mysqli_sql_exception $ex){
    echo "Erro ao tentar se conectar.".PHP_EOL;
}