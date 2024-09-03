<?php
require_once 'models/UserModel.php';
require_once 'models/ClassModel.php';

class ClassesController {
    private $user;
    private $class;

    public function __construct($pdo) {
        $this->user = new UserModel($pdo);
        $this->class = new ClassModel($pdo);
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

            require 'views/classes_view.php';
        } else {
            echo "Utilisateur non trouvé";
        }
    }

    public function createClass($data){
        $this->class->createClass($data);
        header('Location: /edusign/classes');
    }

    public function updateClass($data){
        $this->class->updateClass($data);
        header('Location: /edusign/classes');
    }

    public function deleteClass($data){
        $this->class->deleteClassById($data['class_id']);
        header('Location: /edusign/classes');
    }
}
?>