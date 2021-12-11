<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection()
    {
        return new PDO("sqlite:" . __DIR__ . "./../../../banco.sqlite");
    }
}