<?php
require_once 'models/PresenceModel.php';

class PresenceController {
    
    private $presence;

    public function __construct($pdo) {
        $this->presence = new PresenceModel($pdo);
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

        $course_id = $data['course_id'];

        $token = $this->presence->getTokenByCourseId($course_id);

        if($token == $data['token']){
            $this->presence->updatePresence($_SESSION['user_id'], 1);
        } else {
            var_dump($token, $data['token']);
            echo "erreur: token invalid";
            die();
        }

        header("Location: /course?course_id=$course_id");
    }
}
?>