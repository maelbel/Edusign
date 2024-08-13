<?php

try {
    // Création de la table 'presence'
    $tableSql = "
    CREATE TABLE IF NOT EXISTS es_presence (
        id INT AUTO_INCREMENT PRIMARY KEY,
        classroom_id VARCHAR(100) NOT NULL,
        student_id VARCHAR(100) NOT NULL,
        statut INT NOT NULL,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;
    ";
    $pdo->exec($tableSql);
    // Table 'presence' créée avec succès 
} catch (PDOException $e) {
    die("Erreur lors de la création de la table : " . $e->getMessage());
}
?>