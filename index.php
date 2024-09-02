<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config/config.php';   // Charger la configuration de la base de données
require_once 'router.php';
require 'autoload.php';        // Charger l'autoload pour les migrations
require 'controllers/MigrationController.php';  // Charger le contrôleur de migration
require 'controllers/AuthController.php';

// Instancier le contrôleur de migration avec PDO
$migrationController = new MigrationController($pdo);

// Exécuter toutes les migrations automatiquement
$migrationController->runMigrations();

if (!isset($_SESSION['user_id'])){
    require 'views/login_view.php';
}
?>