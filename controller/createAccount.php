<?php
session_start();

require '../model/db_connect.php';

$pdo->exec("USE edusign");

try {
    // On ajoute 
    $sqlQuery = "INSERT INTO `es_user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES (NULL, '".$_POST["firstname"]."', '".$_POST["lastname"]."', '".$_POST['email']."', '".password_hash($_POST["password"], PASSWORD_DEFAULT)."', '".$_POST['role']."');";
    $statement = $pdo->prepare($sqlQuery);
    $statement->execute();

    header('Location: ../index.php');
    die();
    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>