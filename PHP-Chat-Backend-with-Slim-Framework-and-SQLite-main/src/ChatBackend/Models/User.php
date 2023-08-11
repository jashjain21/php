<?php

namespace jashjain\ChatBackend\Models;

use PDO;

class User
{
    protected $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createTable()
    {
        $this->connection->exec(
            "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY,
                username TEXT NOT NULL,
                password TEXT NOT NULL
            );"
        );
    }
}
