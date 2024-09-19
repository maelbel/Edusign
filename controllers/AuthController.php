<?php
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    public function init() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            header("Location: /account");
            exit();
        }

        require 'views/auth_view.php';
    }

    // Gère la soumission du formulaire de connexion
    public function login($data) {
        if(!$data) header("Location: /auth");
        
        session_start();

        $user = $this->userModel->getUserByEmail($data['email']);

        if ($user) {
            if(password_verify($data['password'], $user['password'])) {
                if (!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']) {
                    echo "Échec de la validation du jeton CSRF.";
                    $errorMessage = sprintf('Échec de la validation du jeton CSRF.');
                    header("Location: /login");
                    exit();
                }
                $_SESSION = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'role' => $user['role']
                ];
                header("Location: /account");
            } else {
                $errorMessage = sprintf('Votre mot de passe est incorrect : (%s/%s)',
                    $data['email'],
                    $data['password']
                );
                require 'views/auth_view.php';
            }
        } else {
            $errorMessage = sprintf("Le compte %s n'existe pas",
                $data['email']
            );
            require 'views/auth_view.php';
        }
    }

    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->userModel->createUser($data);
        header("Location: /accounts");
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /auth");
        exit();
    }
}
?>