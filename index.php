<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/config.php';   // Charger la configuration de la base de données
require_once 'router.php';
require_once 'autoload.php';        // Charger l'autoload pour les migrations
require_once 'controllers/MigrationController.php';  // Charger le contrôleur de migration

// Instancier le contrôleur de migration avec PDO
$migrationController = new MigrationController($pdo);

// Exécuter toutes les migrations automatiquement
$migrationController->runMigrations();
?>