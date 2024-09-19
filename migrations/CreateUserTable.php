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

    public function insert() {
        $sql = 'INSERT IGNORE INTO es_user (firstname, lastname, email, password, role) VALUES
                    ("John", "Doe", "john.doe1@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Jane", "Smith", "jane.smith2@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Tom", "Brown", "tom.brown3@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Emily", "Johnson", "emily.johnson4@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Chris", "Davis", "chris.davis5@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Anna", "Garcia", "anna.garcia6@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Mark", "Martinez", "mark.martinez7@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Lisa", "Miller", "lisa.miller8@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("David", "Rodriguez", "david.rodriguez9@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Sophia", "Wilson", "sophia.wilson10@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Ethan", "Moore", "ethan.moore11@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Olivia", "Taylor", "olivia.taylor12@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("James", "Anderson", "james.anderson13@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Mia", "Thomas", "mia.thomas14@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Noah", "Jackson", "noah.jackson15@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Isabella", "White", "isabella.white16@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Liam", "Harris", "liam.harris17@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Ava", "Martin", "ava.martin18@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Lucas", "Thompson", "lucas.thompson19@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Charlotte", "Garcia", "charlotte.garcia20@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Benjamin", "Lopez", "benjamin.lopez21@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Amelia", "Clark", "amelia.clark22@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Henry", "Lee", "henry.lee23@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Ella", "Lewis", "ella.lewis24@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Sebastian", "Walker", "sebastian.walker25@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Grace", "Hall", "grace.hall26@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Alexander", "Young", "alexander.young27@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Zoe", "King", "zoe.king28@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Daniel", "Scott", "daniel.scott29@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Abigail", "Green", "abigail.green30@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Matthew", "Baker", "matthew.baker31@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Harper", "Gonzalez", "harper.gonzalez32@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Jackson", "Adams", "jackson.adams33@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Lily", "Nelson", "lily.nelson34@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Owen", "Carter", "owen.carter35@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Sofia", "Mitchell", "sofia.mitchell36@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Aiden", "Perez", "aiden.perez37@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Evelyn", "Roberts", "evelyn.roberts38@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Caleb", "Turner", "caleb.turner39@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Mila", "Phillips", "mila.phillips40@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Levi", "Campbell", "levi.campbell41@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Ella", "Parker", "ella.parker42@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Mason", "Evans", "mason.evans43@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Avery", "Edwards", "avery.edwards44@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Scarlett", "Collins", "scarlett.collins45@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Elijah", "Stewart", "elijah.stewart46@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Victoria", "Sanchez", "victoria.sanchez47@example.com", "$2y$10$SzOAlw4cpGHocR/cZUdEoOEeLsewxF5aFWk4O5MdwwGLpOCOFrNTi", "admin"),
                    ("Jacob", "Morris", "jacob.morris48@example.com", "$2y$10$tvm33KWLqcLHdykf.3IvBO1F3XmetEUXnIEHmLqlJysi5znIYahya", "student"),
                    ("Aria", "Reed", "aria.reed49@example.com", "$2y$10$jYP6ApqVVlxbimwDGwgd8.RFtN1pN/04sXqw3P9BPHeDNBCIuOdZ.", "teacher"),
                    ("Logan", "Sanders", "logan.sanders50@example.com", "$2y$10$2MtydEbXLPWfopEWJTR5GuMHxZ7UzCjmDyRzX67yiuyiETTlSYZ1.", "viewer");';
        
        $this->pdo->exec($sql);
    }
}
?>