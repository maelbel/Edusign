<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("USE edusign");
    }

    public function createUser($data) {
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO es_user (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
        $stmt->execute(['firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'password' => $password]);
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

    public function deleteUserById($id){
        $stmt = $this->pdo->prepare("DELETE FROM es_user WHERE id = :id");
        $stmt->execute(['id' => $id ]);
    }
}
?>