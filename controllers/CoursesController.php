<?php
require_once 'models/UserModel.php';
require_once 'models/CourseModel.php';

class CoursesController {
    private $user;
    private $course;

    public function __construct($pdo) {
        $this->user = new UserModel($pdo);
        $this->course = new CourseModel($pdo);
    }

    public function init() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /edusign/login");
            exit();
        }
        if ($_SESSION['role'] != "admin") {
            header("Location: /edusign/account");
            exit();
        }

        $user = $this->user->getUserById($_SESSION['user_id']);

        if ($user) {
            $courses = $this->course->getAllCourses();
            
            $time = $this->roundToNearestHalfHour(new DateTime(date('Y-m-d H:i')));

            require 'views/courses_view.php';
        } else {
            echo "Utilisateur non trouvé";
        }
    }

    // Arrondir à la demi-heure la plus proche
    function roundToNearestHalfHour($dateTime) {
        $minutes = (int)$dateTime->format('i');
        $roundedMinutes = ($minutes < 15) ? 0 : ($minutes < 45 ? 30 : 0);
        if ($roundedMinutes === 0 && $minutes >= 45) {
            $dateTime->modify('+1 hour');
        }
        $dateTime->setTime($dateTime->format('H'), $roundedMinutes);
        return $dateTime;
    }
}
?>