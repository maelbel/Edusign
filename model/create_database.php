<?php
require 'db_connect.php';

$dbname = 'edusign';

try {
    // Création de la base de données
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $pdo->exec($sql);
    // Base de données '$dbname' créée avec succès;

    // Utiliser la base de données créée
    $pdo->exec("USE $dbname");
} catch (PDOException $e) {
    die("Erreur lors de la création de la base de données : " . $e->getMessage());
}

require 'model/create_table_user.php';
require 'model/create_table_classroom.php';
require 'model/create_table_presence.php';
?>