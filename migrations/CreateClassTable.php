<?php
class CreateClassTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table class
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_class (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }
}
?>