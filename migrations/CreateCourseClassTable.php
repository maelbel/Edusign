<?php
class CreateCourseClassTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table course_class
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_course_class (
            course_id INT NOT NULL,
            class_id INT NOT NULL,
            PRIMARY KEY (course_id, class_id),
            FOREIGN KEY (course_id) REFERENCES es_course(id) ON DELETE CASCADE,
            FOREIGN KEY (class_id) REFERENCES es_class(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }

    public function insert() {
        $sql = "INSERT IGNORE INTO es_course_class (course_id, class_id)
                    SELECT c.id, cl.id
                    FROM es_course c
                    JOIN es_class cl
                    ORDER BY RAND();";
        $this->pdo->exec($sql);
    }
}
?>