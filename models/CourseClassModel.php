<?php
class CourseClassModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign");
    }

    public function createCourseClass($course_id, $class_id) {
        $stmt = $this->pdo->prepare("REPLACE INTO es_course_class SET course_id = :course_id, class_id = :class_id");
        $stmt->execute(['course_id' => $course_id, 'class_id' => $class_id]);
    }

    public function getClassIdByCourseId($course_id){
        $stmt = $this->pdo->prepare("SELECT class_id FROM es_course_class WHERE course_id = :course_id");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function deleteCourseClassById($course_id, $class_id){
        $stmt = $this->pdo->prepare("DELETE FROM es_course_class WHERE course_id = :course_id AND class_id = :class_id");
        $stmt->execute(['course_id' => $course_id, 'class_id' => $class_id]);
    }
}
?>