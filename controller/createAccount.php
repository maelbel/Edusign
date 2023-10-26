<?php
    session_start();

    $db = new PDO('mysql:host=localhost;dbname=id21291375_edusign;charset=utf8', 'id21291375_mael', 'Corsica2b*');

    try {
        // On ajoute 
        $sqlQuery = "INSERT INTO `es_user` (`id`, `name`, `lastname`, `email`, `password`, `group_user`) VALUES (NULL, '".$_POST["name"]."', '".$_POST["lastname"]."', '".$_POST['email']."', '".password_hash($_POST["password"], PASSWORD_DEFAULT)."', '".$_POST['group_user']."');";
        $statement = $db->prepare($sqlQuery);
        $statement->execute();

        header('Location: ../index.php');
        die();
        
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>