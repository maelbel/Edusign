<?php

$host = 'localhost'; // Adresse de votre serveur MySQL
$user = 'root';
$pass = '';
$charset = 'utf8';

try {
    // Connexion à MySQL
    $dsn = "mysql:host=$host;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

?>