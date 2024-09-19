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
        $stmt = $this->pdo->prepare("UPDATE es_course SET token = :token WHERE id = :course_id");
        $stmt->execute(['course_id' => $course_id, 'token' => $token]);
    }

    public function updatePresence($user_id, $statut) {
        $stmt = $this->pdo->prepare("UPDATE es_presence SET statut = :statut WHERE user_id = :user_id");
        $stmt->execute(['statut' => $statut, 'user_id' => $user_id]);
    }

    public function getTokenByCourseId($course_id) {
        $stmt = $this->pdo->prepare("SELECT token FROM es_course WHERE id = :course_id");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
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