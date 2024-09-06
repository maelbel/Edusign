<?php
class CourseUserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign");
    }

    public function createCourseUser($course_id, $user_id) {
        $stmt = $this->pdo->prepare("REPLACE INTO es_course_user SET course_id = :course_id, user_id = :user_id");
        $stmt->execute(['course_id' => $course_id, 'user_id' => $user_id]);
    }

    public function getAllTeachersIdByCourseId($course_id){
        $stmt = $this->pdo->prepare("SELECT user_id FROM es_course_user WHERE course_id = :course_id");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function deleteCourseUserById($course_id, $user_id){
        $stmt = $this->pdo->prepare("DELETE FROM es_course_user WHERE course_id = :course_id AND user_id = :user_id");
        $stmt->execute(['course_id' => $course_id, 'user_id' => $user_id]);
    }
}
?>