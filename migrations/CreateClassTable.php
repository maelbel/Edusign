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
            name VARCHAR(100) NOT NULL UNIQUE,
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }

    public function insert() {
        $sql = "INSERT INTO es_class (name) VALUES
                    ('Computer Science'),
                    ('Mechanical Engineering'),
                    ('Business Administration'),
                    ('Electrical Engineering'),
                    ('Mathematics'),
                    ('Physics'),
                    ('Chemical Engineering'),
                    ('Economics'),
                    ('Psychology'),
                    ('Biology');";
        $this->pdo->exec($sql);
    }
}
?>