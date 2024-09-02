<?php
spl_autoload_register(function ($class) {
    // Supposons que les classes des migrations soient dans le dossier migrations
    $classFile = __DIR__ . '/migrations/' . $class . '.php';
    
    // Charger les fichiers des classes des migrations
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});