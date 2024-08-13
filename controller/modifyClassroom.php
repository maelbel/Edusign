<?php
session_start();

require '../model/db_connect.php';

$pdo->exec("USE edusign");

try {
    $students_id = [];
    foreach($_POST as $key => $data){
        if($data == 'on'){
            array_push($students_id, $key);
        }
    }

    // On ajoute un cours
    $sqlQuery = "UPDATE `es_classroom` 
                    SET name = '".$_POST['classname']."', room = '".$_POST['class']."', students_id = '".implode("-", $students_id)."'
                    WHERE id = ".$_POST['classroom_id'];
    $statement = $pdo->prepare($sqlQuery);
    $statement->execute();

    header('Location: ../index.php');
    die();
    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>