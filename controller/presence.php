<?php
session_start();

if(!$_SESSION){
    header("Location: ../index.php");
    die();
}

try {
    $db = new PDO('mysql:host=localhost;dbname=id21291375_edusign;charset=utf8', 'id21291375_mael', 'Corsica2b*');

    $sqlQuery = 'SELECT * FROM `es_classroom` WHERE id = '.$_REQUEST['c_id'].' AND token="'.$_REQUEST['token'].'"';
    $statement = $db->prepare($sqlQuery);
    $statement->execute();
    $classroom = $statement->fetch();

    if($classroom and sizeof($classroom) > 0 and $_SESSION['group_user'] == 1){
        $sqlQuery = "UPDATE `es_presence` SET statut=1 WHERE student_id=".$_SESSION['id']." AND classroom_id=".$_REQUEST['c_id'];
        $statement = $db->prepare($sqlQuery);
        $statement->execute();
    } 

    header("Location: ../classroom.php?c_id=".$_REQUEST['c_id']);
    die();
    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>