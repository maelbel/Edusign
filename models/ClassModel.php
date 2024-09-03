<?php
class ClassModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign");
    }

    public function createClass($data) {
        $stmt = $this->pdo->prepare("INSERT INTO es_class (name) VALUES (:name)");
        $stmt->execute(['name' => $data['name']]);
    }

    public function updateClass($data) {
        $stmt = $this->pdo->prepare("UPDATE es_class SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $data['name'], 'id' => $data['class_id']]);
    }

    public function getClassById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_class WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllClasses() {
        $stmt = $this->pdo->query("SELECT * FROM es_class");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClassesByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_class 
                                        INNER JOIN es_class_user
                                            ON es_class.id = es_class_user.class_id
                                        INNER JOIN es_user
                                            ON es_class_user.user_id = es_user.id
                                        WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteClassById($id){
        $stmt = $this->pdo->prepare("DELETE FROM es_class WHERE id = :id");
        $stmt->execute(['id' => $id ]);
    }
}
?>