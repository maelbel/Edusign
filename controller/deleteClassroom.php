<?php
    session_start();

    $db = new PDO('mysql:host=localhost;dbname=id21291375_edusign;charset=utf8', 'id21291375_mael', 'Corsica2b*');

    try {
        // On supprime le cours
        $sqlQuery = "DELETE FROM `es_classroom` WHERE id = ".$_REQUEST["c_id"].";";
        $statement = $db->prepare($sqlQuery);
        $statement->execute();
        
        // On supprime la liste des présences associés
        $sqlQuery = "DELETE FROM `es_presence` WHERE classroom_id = ".$_REQUEST["c_id"].";";
        $statement = $db->prepare($sqlQuery);
        $statement->execute();

        header('Location: ../index.php');
        die();

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>