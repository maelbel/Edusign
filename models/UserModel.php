<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign_database");
    }

    public function createUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO es_user (firstname, lastname, email, password, role) VALUES (:firstname, :lastname, :email, :password, :role)");
        $stmt->execute(['firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'password' => $data['password'], 'role' => $data['role']]);
    }

    public function updateUser($data) {
        $stmt = $this->pdo->prepare("UPDATE es_user SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, role = :role WHERE id = :id");
        $stmt->execute(['firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'password' => $data['password'], 'role' => $data['role'], 'id' => $data['user_id']]);
    }

    public function getUserById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM es_user WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM es_user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(){
        $stmt = $this->pdo->query("SELECT * FROM es_user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTeachers(){
        $stmt = $this->pdo->prepare("SELECT * FROM es_user WHERE role = :role");
        $stmt->execute([':role' => 'teacher']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllStudents(){
        $stmt = $this->pdo->prepare("SELECT * FROM es_user WHERE role = :role");
        $stmt->execute([':role' => 'student']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUserById($id){
        $stmt = $this->pdo->prepare("DELETE FROM es_user WHERE id = :id");
        $stmt->execute(['id' => $id ]);
    }
}
?>