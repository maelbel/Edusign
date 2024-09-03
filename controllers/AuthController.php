<?php
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    // Gère la soumission du formulaire de connexion
    public function login($data) {
        $user = $this->userModel->getUserByEmail($data['email']);

        if ($user) {
            if(password_verify($data['password'], $user['password'])){
                // Connexion réussie, démarre la session
                session_start();
                if (!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']) {
                    echo "Échec de la validation du jeton CSRF.";
                    $errorMessage = sprintf('Échec de la validation du jeton CSRF.');
                    header("Location: /edusign/login");
                    exit();
                }
                $_SESSION = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'role' => $user['role']
                ];
                header("Location: /edusign/account");
            } else {
                $errorMessage = sprintf('Votre mot de passe est incorrect : (%s/%s)',
                    $_POST['email'],
                    $_POST['password']
                );
                require 'views/login_view.php';
            }
        } else {
            $errorMessage = sprintf("Le compte %s n'existe pas",
                $_POST['email']
            );
            require 'views/login_view.php';
        }
    }

    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->userModel->createUser($data);
        header("Location: /edusign/accounts");
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /edusign/");
        exit();
    }
}
?>