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
    $sqlQuery = "INSERT INTO `es_classroom` (`id`, `name`, `room`, `students_id`, `teacher_id`, `token`) VALUES (NULL, '".$_POST["classname"]."', '".$_POST["class"]."', '".implode("-", $students_id)."', ".$_SESSION["id"].", null);";
    $statement = $pdo->prepare($sqlQuery);
    $statement->execute();
    
    $classroomCreated = $pdo->lastInsertId();
    // On ajoute la liste des participants
    foreach($students_id as $student_id) {
        $sqlQuery = "INSERT INTO `es_presence` (`id`, `classroom_id`, `student_id`, `statut`) VALUES (NULL, ".$classroomCreated.", ".$student_id.", 0);";
        $statement = $pdo->prepare($sqlQuery);
        $statement->execute();
    }

    header('Location: ../index.php');
    die();
    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>