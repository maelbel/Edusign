<?php
class DashboardController {

    public function __construct($pdo) {

    }

    public function init() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
            exit();
        }
        if ($_SESSION['role'] != "admin") {
            header("Location: /account");
            exit();
        }
        require 'views/dashboard_view.php';
    }
}
?>