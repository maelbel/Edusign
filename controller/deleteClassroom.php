<?php
session_start();

require '../model/db_connect.php';

$pdo->exec("USE edusign");

try {
    // On supprime le cours
    $sqlQuery = "DELETE FROM `es_classroom` WHERE id = ".$_REQUEST["c_id"].";";
    $statement = $pdo->prepare($sqlQuery);
    $statement->execute();
    
    // On supprime la liste des présences associés
    $sqlQuery = "DELETE FROM `es_presence` WHERE classroom_id = ".$_REQUEST["c_id"].";";
    $statement = $pdo->prepare($sqlQuery);
    $statement->execute();

    header('Location: ../index.php');
    die();

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>