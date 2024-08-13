<?php

try {
    // Création de la table 'user'
    $tableSql = "
    CREATE TABLE IF NOT EXISTS es_user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'teacher', 'student') NOT NULL DEFAULT 'student',
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;
    ";
    $pdo->exec($tableSql);
    // Table 'user' créée avec succès
} catch (PDOException $e) {
    die("Erreur lors de la création de la table : " . $e->getMessage());
}
?>