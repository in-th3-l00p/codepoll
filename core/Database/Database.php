<?php

namespace core\Database;

use PDO;


class Database {
    private PDO $pdo;

    public function __construct()
    {
        $config = include(BASE_PATH . 'config/database.php');
        $this->pdo = new PDO(
            "mysql:host={$config["DB_HOST"]};dbname={$config["DB_NAME"]};charset=utf8mb4",
            $config["DB_USER"], $config["DB_PASSWORD"]
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}