<?php
require_once 'models/UserModel.php';
require_once 'models/ClassModel.php';
require_once 'models/ClassUserModel.php';

class ClassesController {

    private $pdo;
    private $user;
    private $class;
    private $classUser;    

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->user = new UserModel($pdo);
        $this->class = new ClassModel($pdo);
        $this->classUser = new ClassUserModel($pdo);
    }

    public function init() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /edusign/");
            exit();
        }
        if ($_SESSION['role'] != "admin") {
            header("Location: /edusign/account");
            exit();
        }

        $user = $this->user->getUserById($_SESSION['user_id']);

        if ($user) {
            $classes = $this->class->getAllClasses();

            $students = $this->user->getAllStudents();



            require 'views/classes_view.php';

        } else {
            echo "Utilisateur non trouvé";
        }
    }

    public function createClass($data){
        $this->class->createClass($data);

        $class_id = $this->pdo->lastInsertId();
        $students = $this->user->getAllStudents();

        if($students && $data['students']){
            foreach($students as $student) {
                if(in_array($student['id'], $data['students'])){
                    $this->classUser->createClassUser($class_id, $student['id']);
                } else {
                    $this->classUser->deleteClassUserById($class_id, $student['id']);
                }
            }
        }

        header('Location: /edusign/classes');
    }

    public function updateClass($data){
        $this->class->updateClass($data);
        
        $students = $this->user->getAllStudents();

        if($students && $data['students']){
            foreach($students as $student) {
                if(in_array($student['id'], $data['students'])){
                    $this->classUser->createClassUser($data['class_id'], $student['id']);
                } else {
                    $this->classUser->deleteClassUserById($data['class_id'], $student['id']);
                }
            }
        }

        header('Location: /edusign/classes');
    }

    public function deleteClass($data){
        $this->class->deleteClassById($data['class_id']);
        header('Location: /edusign/classes');
    }

    public function getClassUser(){
        return $this->classUser;
    }
}
?>