<?php
class CreateCourseUserTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table course_class
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_course_user (
            course_id INT NOT NULL,
            user_id INT NOT NULL,
            PRIMARY KEY (course_id, user_id),
            FOREIGN KEY (course_id) REFERENCES es_course(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES es_user(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }
}
?>