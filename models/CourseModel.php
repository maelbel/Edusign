<?php
class CourseModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign");
    }

    public function createCourse($data) {
        $stmt = $this->pdo->prepare("INSERT INTO es_course (name, room, token, date, duration) VALUES (:name, :room, :token, :date, :duration)");
        $stmt->execute(['name' => $data['name'], 'room' => $data['room'], 'token' => null, 'date' => $data['date'], 'duration' => $data['duration']]);
    }

    public function getCourseById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_course WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCourses() {
        $stmt = $this->pdo->query("SELECT * FROM es_course");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_course 
                                        INNER JOIN es_course_class 
                                            ON es_course.id = es_course_class.course_id 
                                        INNER JOIN es_class
                                            ON es_course_class.class_id = es_class.id
                                        INNER JOIN es_class_user
                                            ON es_class.id = es_class_user.class_id
                                        INNER JOIN es_user
                                            ON es_class_user.user_id = es_user.id
                                        WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCourseById($id){
        $stmt = $this->pdo->prepare("DELETE FROM es_course WHERE id = :id");
        $stmt->execute(['id' => $id ]);
    }
}
?>