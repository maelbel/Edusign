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

    public function insert() {
        $sql = "INSERT IGNORE INTO course (name, room, start_date, end_date) VALUES
                    ('Introduction to Computer Science', '101', '2024-09-06 10:00:00', '2024-09-06 10:30:00'),
                    ('Advanced Mathematics', '102', '2024-09-06 12:30:00', '2024-09-06 13:00:00'),
                    ('Physics I', '203', '2024-09-07 09:00:00', '2024-09-07 09:30:00'),
                    ('Business Strategy', '204', '2024-09-07 11:00:00', '2024-09-07 11:30:00'),
                    ('Organic Chemistry', '301', '2024-09-08 14:00:00', '2024-09-08 14:30:00'),
                    ('Psychology 101', '302', '2024-09-08 15:30:00', '2024-09-08 16:00:00'),
                    ('Electrical Engineering Basics', '105', '2024-09-09 10:30:00', '2024-09-09 11:00:00'),
                    ('Economics Principles', '106', '2024-09-09 13:00:00', '2024-09-09 13:30:00'),
                    ('Mechanical Systems', '401', '2024-09-10 09:30:00', '2024-09-10 10:00:00'),
                    ('Biology Foundations', '402', '2024-09-10 11:30:00', '2024-09-10 12:00:00');";
        $this->pdo->exec($sql);
    }
}
?>