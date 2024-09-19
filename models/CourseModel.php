<?php
class CourseModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign_database");
    }

    public function createCourse($data) {
        $stmt = $this->pdo->prepare("INSERT INTO es_course (name, room, token, start_date, end_date) VALUES (:name, :room, :token, :start_date, :end_date)");
        $stmt->execute(['name' => $data['name'], 'room' => $data['room'], 'token' => null, 'start_date' => $data['start_date'], 'end_date' => $data['end_date']]);
    }

    public function updateCourse($data) {
        $stmt = $this->pdo->prepare("UPDATE es_course SET name = :name, room = :room, start_date = :start_date, end_date = :end_date WHERE id = :id");
        $stmt->execute(['name' => $data['name'], 'room' => $data['room'], 'start_date' => $data['start_date'], 'end_date' => $data['end_date'], 'id' => $data['course_id']]);
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

    public function getCoursesByStudentId($user_id) {
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

    public function getCoursesByTeacherId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_course 
                                        INNER JOIN es_course_user 
                                            ON es_course.id = es_course_user.user_id 
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