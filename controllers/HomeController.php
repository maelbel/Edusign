<?php
class HomeController {

    public function __construct($pdo) {

    }

    public function init() {
        session_start();
        require 'views/home_view.php';
    }
}
?>