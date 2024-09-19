<?php
// Définir les routes
$routes = [
    '' => 'HomeController@init',

    'auth' => 'AuthController@init',
    'login' => 'AuthController@login',
    'register' => 'AuthController@register',
    'logout' => 'AuthController@logout',

    'account' => 'AccountController@init',

    'course' => 'CourseController@init',
    'course/qrcode' => 'CourseController@ajax',

    'dashboard' => 'DashboardController@init',

    'accounts' => 'AccountsController@init',
    'updateUser' => 'AccountsController@updateUser',
    'deleteUser' => 'AccountsController@deleteUser',

    'classes' => 'ClassesController@init',
    'createClass' => 'ClassesController@createClass',
    'updateClass' => 'ClassesController@updateClass',
    'deleteClass' => 'ClassesController@deleteClass',

    'courses' => 'CoursesController@init',
    'createCourse' => 'CoursesController@createCourse',
    'updateCourse' => 'CoursesController@updateCourse',
    'deleteCourse' => 'CoursesController@deleteCourse',

    'presence' => 'PresenceController@init'
];

// Obtenir l'URL de la requête
// $requestUri = str_replace('/edusign', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Fonction pour exécuter l'action correcte basée sur la requête
function handleRequest($routes, $requestUri, $requestMethod, $pdo) {
    
    foreach ($routes as $route => $action) {
        // Si l'URI correspond à la route
        if ($requestUri === "/$route") {
            list($controller, $method) = explode('@', $action);
            require_once "controllers/$controller.php";
            $controllerInstance = new $controller($pdo);

            // Exécuter la méthode correcte du contrôleur en fonction du type de requête
            if ($requestMethod === 'POST' && method_exists($controllerInstance, $method)) {
                return $controllerInstance->$method($_POST);
            } elseif ($requestMethod === 'GET' && method_exists($controllerInstance, $method)) {
                return $controllerInstance->$method($_GET);
            }
        }
    }

    // Si la route n'existe pas
    http_response_code(404);
    return null;
}

// Gérer la requête
handleRequest($routes, $requestUri, $requestMethod, $pdo);
?>