<?php
class CreateUserTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table users
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_user (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin', 'teacher', 'student', 'viewer') NOT NULL DEFAULT 'viewer',
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }
}
?>