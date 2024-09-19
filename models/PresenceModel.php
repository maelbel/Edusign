<?php
class PresenceModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign_database");
    }

    public function createPresence($course_id, $user_id, $statut = 0) {
        $stmt = $this->pdo->prepare("REPLACE INTO es_presence SET course_id = :course_id, user_id = :user_id, statut = :statut");
        $stmt->execute(['course_id' => $course_id, 'user_id' => $user_id, 'statut' => $statut]);
    }

    public function updateToken($course_id, $token) {
        $stmt = $this->pdo->prepare("UPDATE es_presence SET token = :token WHERE course_id = :course_id");
        $stmt->execute(['course_id' => $course_id, 'token' => $token]);
    }

    public function getTokenByCourseId($course_id) {
        $stmt = $this->pdo->prepare("SELECT token FROM es_presence WHERE course_id = :cours_id");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPresences() {
        $stmt = $this->pdo->query("SELECT * FROM es_presence");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPresencesByCourseId($course_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_presence 
                                        INNER JOIN es_course 
                                            ON es_course.id = es_presence.course_id 
                                        WHERE course_id = :course_id");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePresenceById($id){
        $stmt = $this->pdo->prepare("DELETE FROM es_presence WHERE id = :id");
        $stmt->execute(['id' => $id ]);
    }
}
?>