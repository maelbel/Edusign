<?php
session_start();

try {
	$db = new PDO('mysql:host=localhost;dbname=id21291375_edusign;charset=utf8', 'id21291375_mael', 'Corsica2b*');
    
    // On récupère tous les utilisateurs
    $sqlQuery = 'SELECT * FROM es_user';
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $users = $recipesStatement->fetchAll();

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./src/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="./src/css/fontawesome/all.min.css">
        <link rel="stylesheet" href="./src/css/style.css">
    </head>
    <body>
    <?php

        // Validation du formulaire
        if (isset($_POST['email']) && isset($_POST['password'])) {
            foreach ($users as $user) {
                if (
                    $user['email'] === $_POST['email'] &&
                    password_verify($_POST['password'], $user['password'])
                ) {
                    $_SESSION = [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'lastname' => $user['lastname'],
                        'group_user' => $user['group_user']
                    ];
                } else {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                        $_POST['email'],
                        $_POST['password']
                    );
                }
            }
        }
        ?>

        <!--
        Si utilisateur/trice est non identifié(e), on affiche le formulaire
        -->
        <?php if(!isset($_SESSION) || sizeof($_SESSION) == 0): ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 my-5">
                    <h1>Vous devez être connecté pour utiliser cette application</h1>
                    <form action="index.php" method="post">
                        <!-- si message d'erreur on l'affiche -->
                        <?php if(isset($errorMessage)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- 
            Si utilisateur/trice est bien connectée on affiche un message de succès
        -->
        <?php else: ?>
            <div class="container mt-5">
                <div class="row">
                    <div class="alert alert-success mb-0" role="alert">
                        <span class="h3">Bonjour <?php echo $_SESSION['name'].' '.$_SESSION['lastname']; ?> !</span>
                        <br/>
                        <span class="text-muted">Espace 
                            <?php switch($_SESSION['group_user']) {
                                        case 0:
                                            echo 'administrateur';
                                            break;
                                        case 1:
                                            echo 'étudiant';
                                            break;
                                        case 2:
                                            echo 'professeur';
                                            break;
                                        default:
                                            echo 'personnel';
                                            break;
                            } ?>
                        </span>
                    </div>
                    <form action="controller/logout.php" method="post" class="p-0 mb-5">
                        <input type="submit" class="btn btn-danger col-12" name="logout" value="Déconnexion" />
                    </form>
                </div>
                <div class="row">
                    <?php if($_SESSION['group_user'] == 0): ?>
                    
                    <span class="h4">Créer un compte</span>
                    
                    <form action="controller/createAccount.php" method="post" class="mb-5">
                        <div class="row mb-3">
                            <div class="col-6">
                            <label for="name" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col-6">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="group_user">Groupe de l'utilisateur:</label>
                            <select name="group_user" id="group_user">
                                <option value="1">Étudiant</option>
                                <option value="0">Administrateur</option>
                                <option value="2">Professeur</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer un compte</button>
                    </form>
                    
                    <span class="h4">Liste des comptes</span>
                    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Groupe</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $user){ ?>
                            <tr>
                                <th scope="row"><?php echo $user['id']; ?></th>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['lastname']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php switch($user['group_user']) {
                                        case 0:
                                            echo 'Administrateur';
                                            break;
                                        case 1:
                                            echo 'Étudiant';
                                            break;
                                        case 2:
                                            echo 'Professeur';
                                            break;
                                        default:
                                            echo 'Aucun';
                                            break;
                                } ?></td>
                                <td>
                                    <button id="modifyAccountBtn" type="button" class="btn btn-primary text-white py-2 px-3" data-bs-toggle="modal" data-bs-target="#modifyAccountModal">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <a class="btn btn-danger text-white py-2 px-3" href="controller/deleteUser.php?u_id=<?php echo $user['id']?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php else: ?>
                        <span class="h4">Vos cours</span>
                    <?php endif; ?>

                    <?php 
                        $id_temp = ($_SESSION['group_user'] == 2)?'teacher_id':'students_id';
                        // On récupère tous les cours de la personne connectée
                        $sqlQuery = 'SELECT * FROM es_classroom WHERE '.$id_temp.' = '.$_SESSION['id'];
                        $statement = $db->prepare($sqlQuery);
                        $statement->execute();
                        $classrooms = $statement->fetchAll();

                        foreach($classrooms as $classroom){ ?>
                            <div class="row mb-3">
                                <div class="<?php echo ($_SESSION['group_user'] == 2)? 'col-10' : 'col-12'; ?>">
                                    <a class="btn btn-light text-start w-100" href="classroom.php?c_id=<?php echo $classroom['id'] ?>">
                                        <div class="col-12">
                                            <div class="h4"><?php echo $classroom['name']; ?></div>
                                            <span class="text-muted"><?php echo $classroom['room']; ?></span>
                                        </div>
                                    </a>
                                </div>
                                
                                <?php if($_SESSION['group_user'] == 2): ?>
                                    <div class="col-1">
                                        <button id="modifyClassBtn" type="button" class="btn btn-primary text-white w-100 p-4" data-bs-toggle="modal" data-bs-target="#modifyClassModal">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="modifyClassModal" tabindex="-1" aria-labelledby="modifyClassModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le cours</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="controller/modifyClassroom.php" method="POST">
                                                        <input type="hidden" id="classroom_id" name="classroom_id" value="<?php echo $classroom['id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="classname" class="form-label">Nom</label>
                                                                <input type="text" class="form-control" id="classname" name="classname" placeholder="<?php echo $classroom['name'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="class" class="form-label">Salle</label>
                                                                <input type="text" class="form-control" id="class" name="class" placeholder="<?php echo $classroom['room'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <?php foreach($users as $user) { 
                                                                        if($user['group_user']==1){ ?>
                                                                            <input type="checkbox" name="<?php echo $user['id'] ?>" id="<?php echo $user['id'] ?>" <?php echo (in_array($user['id'], explode("-", $classroom['students_id'])))? 'checked' : '' ?>/>
                                                                            <label for="<?php echo $user['id'] ?>"><?php echo $user['name'].' '.$user['lastname'] ?></label>
                                                                <?php }} ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary" name="createClass" id="createClass">Modifier le cours</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <a class="btn btn-danger text-white w-100 p-4" href="controller/deleteClassroom.php?c_id=<?php echo $classroom['id']?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                    <?php } ?>

                    <?php if($_SESSION['group_user'] == 2): ?>
                        <!-- Button trigger modal -->
                        <button id="addClassBtn" type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#addClassModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un cours</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="controller/createClassroom.php" method="POST">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="classname" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="classname" name="classname">
                                            </div>
                                            <div class="mb-3">
                                                <label for="class" class="form-label">Salle</label>
                                                <input type="text" class="form-control" id="class" name="class">
                                            </div>
                                            <div class="mb-3">
                                                <?php foreach($users as $user) { 
                                                        if($user['group_user']==1){ ?>
                                                            <input type="checkbox" name="<?php echo $user['id'] ?>" id="<?php echo $user['id'] ?>"/>
                                                            <label for="<?php echo $user['id'] ?>"><?php echo $user['name'].' '.$user['lastname'] ?></label>
                                                <?php }} ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary" name="createClass" id="createClass">Créer un cours</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endif; ?>
        
        <script src="./src/js/jquery.js"></script>
        <script src="./src/js/bootstrap/bootstrap.js"></script>
        <script type="text/javascript">
            const myModal = document.getElementById('addClassModal');
            const myInput = document.getElementById('addClassBtn');

            myModal.addEventListener('shown.bs.modal', () => {
                myInput.focus();
            })
        </script>
    </body>
</html>