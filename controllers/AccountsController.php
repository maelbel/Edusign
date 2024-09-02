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
            header("Location: /edusign/login");
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
}
?>