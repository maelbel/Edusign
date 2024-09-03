<?php
require_once 'models/UserModel.php';
require_once 'models/CourseModel.php';

class AccountController {
    private $user;
    private $course;

    public function __construct($pdo) {
        $this->user = new UserModel($pdo);
        $this->course = new CourseModel($pdo);
    }

    public function init() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /edusign/");
            exit();
        }

        $user = $this->user->getUserById($_SESSION['user_id']);

        if ($user) {
            if ($user['role'] == "admin") $users = $this->user->getAllUsers();

            $courses = $this->course->getCoursesByUserId($user['id']);

            require 'views/account_view.php';
        } else {
            echo "Utilisateur non trouvé";
        }
    }
}
?>