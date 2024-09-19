<?php
require_once 'models/CourseModel.php';
require_once 'models/PresenceModel.php';
require_once 'models/UserModel.php';

class CourseController {
    
    private $course;
    private $presence;
    private $user;

    public function __construct($pdo) {
        $this->course = new CourseModel($pdo);
        $this->presence = new PresenceModel($pdo);
        $this->user = new UserModel($pdo);
    }

    public function init($data) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
            exit();
        }
        if ($_SESSION['role'] == "viewer") {
            header("Location: /account");
            exit();
        }

        $course = $this->course->getCourseById($data['course_id']);

        $presences = $this->presence->getPresencesByCourseId($course['id']);

        require 'views/course_view.php';
    }

    public function ajax($data){
        session_start();
        include('phpqrcode/qrlib.php');

        $oldToken = $this->presence->getTokenByCourseId($data['course_id']);

        $this->presence->updateToken($data['course_id'], $data['token']);

        $lien = 'https://edusign.alwaysdata.net/presence?course_id='.$data['course_id'].'&token='.$data['token'];
        QRcode::png($lien, 'src/img/tmp/qrcode/qrcode-'.$data['token'].'.png'); // On crée notre QR Code
        
        // On supprime l'ancien qrcode
        if(file_exists('src/img/tmp/qrcode/qrcode-'.$oldToken['token'])){
            unlink('src/img/tmp/qrcode/qrcode-'.$oldToken['token']);
        }

        echo $lien;
    }

    public function getUser() {
        return $this->user;
    }
}
?>