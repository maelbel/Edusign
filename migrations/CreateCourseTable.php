<?php
class CreateCourseTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table course
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_course (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            room VARCHAR(100) NOT NULL,
            token VARCHAR(100),
            start_date DATETIME,
            end_date DATETIME
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }
}
?>