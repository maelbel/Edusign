<?php
require_once 'models/UserModel.php';

class AccountsController {
    private $user;

    public function __construct($pdo) {
        $this->user = new UserModel($pdo);
    }

    public function init() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /edusign/");
            exit();
        }
        if ($_SESSION['role'] != "admin") {
            header("Location: /edusign/account");
            exit();
        }

        $user = $this->user->getUserById($_SESSION['user_id']);

        if ($user) {
            $users = $this->user->getAllUsers();

            require 'views/accounts_view.php';
        } else {
            echo "Utilisateur non trouvé";
        }
    }

    public function updateUser($data){
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->user->updateUser($data);
        header('Location: /edusign/accounts');
    }

    public function deleteUser($data){
        $this->user->deleteUserById($data['user_id']);
        header('Location: /edusign/accounts');
    }
}
?>