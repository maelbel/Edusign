<?php
class Database {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crée la base de données si elle n'existe pas
    public function createDatabase($dbName) {
        $sql = "CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        $this->pdo->exec($sql);
    }
}
?>