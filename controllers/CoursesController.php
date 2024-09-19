<?php
require_once 'models/UserModel.php';
require_once 'models/CourseModel.php';
require_once 'models/ClassModel.php';
require_once 'models/CourseClassModel.php';
require_once 'models/CourseUserModel.php';

class CoursesController {

    private $pdo;
    private $user;
    private $course;
    private $class;
    private $courseClass;
    private $courseUser;


    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->user = new UserModel($pdo);
        $this->course = new CourseModel($pdo);
        $this->class = new ClassModel($pdo);
        $this->courseClass = new CourseClassModel($pdo);
        $this->courseUser = new CourseUserModel($pdo);
    }

    public function init() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /");
            exit();
        }
        if ($_SESSION['role'] != "admin") {
            header("Location: /account");
            exit();
        }

        $user = $this->user->getUserById($_SESSION['user_id']);

        if ($user) {
            $courses = $this->course->getAllCourses();

            $classes = $this->class->getAllClasses();

            $teachers = $this->user->getAllTeachers();
            
            $time = $this->roundToNearestHalfHour(new DateTime(date('Y-m-d H:i')));

            require 'views/courses_view.php';
        } else {
            echo "Utilisateur non trouvé";
        }
    }

    public function createCourse($data){
        $this->course->createCourse($data);

        $course_id = $this->pdo->lastInsertId();

        $classes = $this->class->getAllClasses();
        $teachers = $this->user->getAllTeachers();

        if($classes && $teachers && $data['class'] && $data['teachers']){
            foreach($classes as $class) {
                if($class['id'] == $data['class']){
                    $this->courseClass->createCourseClass($course_id, $class['id']);
                } else {
                    $this->courseClass->deleteCourseClassById($course_id, $class['id']);
                }
            }
            foreach($teachers as $teacher) {
                if(in_array($teacher['id'], $data['teachers'])){
                    $this->courseUser->createCourseUser($course_id, $teacher['id']);
                } else {
                    $this->courseUser->deleteCourseUserById($course_id, $teacher['id']);
                }
            }
        }

        header('Location: /courses');
    }

    public function updateCourse($data){
        $this->course->updateCourse($data);

        $classes = $this->class->getAllClasses();
        $teachers = $this->user->getAllTeachers();

        if($classes && $data['class']){
            foreach($classes as $class) {
                if($class['id'] == $data['class']){
                    $this->courseClass->createCourseClass($data['course_id'], $class['id']);
                } else {
                    $this->courseClass->deleteCourseClassById($data['course_id'], $class['id']);
                }
            }
        }

        if($teachers && $data['teachers']){
            foreach($teachers as $teacher) {
                if(in_array($teacher['id'], $data['teachers'])){
                    $this->courseUser->createCourseUser($data['course_id'], $teacher['id']);
                } else {
                    $this->courseUser->deleteCourseUserById($data['course_id'], $teacher['id']);
                }
            }
        }

        header('Location: /courses');
    }

    public function deleteCourse($data){
        $this->course->deleteCourseById($data['course_id']);
        header('Location: /courses');
    }

    public function getCourseClass() {
        return $this->courseClass;
    }

    public function getCourseUser() {
        return $this->courseUser;
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