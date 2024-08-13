<?php

try {
    // Création de la table 'classroom'
    $tableSql = "
    CREATE TABLE IF NOT EXISTS es_classroom (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        room VARCHAR(100) NOT NULL,
        teacher_id INT NOT NULL,
        students_id VARCHAR(100) NOT NULL,
        token VARCHAR(100) NOT NULL,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;
    ";
    $pdo->exec($tableSql);
    // Table 'classroom' créée avec succès 
} catch (PDOException $e) {
    die("Erreur lors de la création de la table : " . $e->getMessage());
}
?>