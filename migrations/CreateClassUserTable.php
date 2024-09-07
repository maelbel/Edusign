<?php
class CreateClassUserTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table class_user
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_class_user (
            class_id INT NOT NULL,
            user_id INT NOT NULL,
            PRIMARY KEY (class_id, user_id),
            FOREIGN KEY (class_id) REFERENCES es_class(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES es_user(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }

    public function insert() {
        $sql = "INSERT IGNORE INTO es_class_user (class_id, user_id)
                    SELECT c.id, u.id
                    FROM es_class c
                    JOIN es_user u ON u.role = 'student'
                    ORDER BY RAND()
                    LIMIT 20;";
        $this->pdo->exec($sql);
    }
}
?>