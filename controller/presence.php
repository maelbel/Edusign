<?php
session_start();

if(!$_SESSION){
    header("Location: ../index.php");
    die();
}

require '../model/db_connect.php';

$pdo->exec("USE edusign");

try {
    $sqlQuery = 'SELECT * FROM `es_classroom` WHERE id = '.$_REQUEST['c_id'].' AND token="'.$_REQUEST['token'].'"';
    $statement = $pdo->prepare($sqlQuery);
    $statement->execute();
    $classroom = $statement->fetch();

    if($classroom and sizeof($classroom) > 0 and $_SESSION['role'] == "student"){
        $sqlQuery = "UPDATE `es_presence` SET statut=1 WHERE student_id=".$_SESSION['id']." AND classroom_id=".$_REQUEST['c_id'];
        $statement = $pdo->prepare($sqlQuery);
        $statement->execute();
    } 

    header("Location: ../view/classroom.php?c_id=".$_REQUEST['c_id']);
    die();
    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>