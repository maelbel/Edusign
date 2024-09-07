<?php
require_once 'models/Database.php';

class MigrationController {
    private $pdo;
    private $migrations = [];

    public function __construct($pdo) {
        $this->pdo = $pdo;

        // Liste des classes de migration que vous voulez exécuter
        $this->migrations = [
            'CreateUserTable',
            'CreateClassTable',
            'CreateCourseTable',
            'CreatePresenceTable',
            'CreateClassUserTable',
            'CreateCourseClassTable',
            'CreateCourseUserTable'
            // Ajoutez ici d'autres migrations comme 'CreateOtherTable'
        ];
    }

    // Exécuter toutes les migrations
    public function runMigrations() {
        // Créer la base de données
        $db = new Database($this->pdo);
        $db->createDatabase('edusign');

        $this->pdo->exec("USE edusign");

        foreach ($this->migrations as $migration) {
            // Charger la classe dynamiquement et créer la table
            $migrationClass = new $migration($this->pdo);
            $migrationClass->createTable();

            if(method_exists($migrationClass, "insert")){
                $migrationClass->insert();
            }
        }
    }
}
?>