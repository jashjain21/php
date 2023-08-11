<?php

namespace jashjain\ChatBackend\Models;

use PDO;

class Group
{
    protected $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createTable()
    {
        $this->connection->exec(
            "CREATE TABLE IF NOT EXISTS groups (
                id INTEGER PRIMARY KEY,
                group_name TEXT NOT NULL
            );"
        );
    }
}
