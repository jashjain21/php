<?php

namespace jashjain\ChatBackend\Models;

use PDO;

class UserGroup
{
    protected $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createTable()
    {
        $this->connection->exec(
            "CREATE TABLE IF NOT EXISTS usergroup (
                id INTEGER PRIMARY KEY,
                user_id INTEGER NOT NULL,
                group_id INTEGER NOT NULL,
                FOREIGN KEY (group_id) REFERENCES groups (id),
                FOREIGN KEY (user_id) REFERENCES users (id)
            );"
        );
    }
}
