<?php
class ClassUserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign");
    }

    public function createClassUser($class_id, $user_id) {
        $stmt = $this->pdo->prepare("REPLACE INTO es_class_user SET class_id = :class_id, user_id = :user_id");
        $stmt->execute(['class_id' => $class_id, 'user_id' => $user_id]);
    }

    public function getAllStudentsIdByClassId($class_id){
        $stmt = $this->pdo->prepare("SELECT user_id FROM es_class_user WHERE class_id = :class_id");
        $stmt->execute([':class_id' => $class_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function deleteClassUserById($class_id, $user_id){
        $stmt = $this->pdo->prepare("DELETE FROM es_class_user WHERE class_id = :class_id AND user_id = :user_id");
        $stmt->execute(['class_id' => $class_id, 'user_id' => $user_id]);
    }
}
?>