<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection()
    {
        $connection =  new PDO("sqlite:" . __DIR__ . "./../../../banco.sqlite");
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}