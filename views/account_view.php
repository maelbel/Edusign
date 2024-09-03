<?php 
    require 'views/partials/head.php';
    require 'views/partials/header.php';
?>

<div class="row">
    <div class="alert alert-success mb-0" role="alert">
        <span class="h3">Bonjour <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?> !</span>
        <br/>
        <span class="text-muted">Espace <?php echo $_SESSION['role'] ?>
        </span>
    </div>
    <form action="/edusign/logout" method="post" class="p-0 mb-5">
        <input type="submit" class="btn btn-danger col-12" name="logout" value="Déconnexion" />
    </form>
</div>
<?php if($_SESSION['role'] == "admin"): ?>
<div class="row justify-content-between mb-5">
    <a class="btn btn-primary col-3" href="/edusign/accounts">Gérer les comptes</a>
    <a class="btn btn-primary col-3" href="/edusign/classes">Gérer les classes</a>
    <a class="btn btn-primary col-3" href="/edusign/courses">Gérer les cours</a>
</div>
<?php endif; ?>
<div class="row">
    <span class="h4">Vos cours</span>

    <?php if(count($courses) > 0): ?>
    <?php foreach($courses as $course){ ?>
            <div class="row mb-3">
                <div class="<?php echo ($_SESSION['role'] == "teacher")? 'col-10' : 'col-12'; ?>">
                    <a class="btn btn-light text-start w-100" href="./view/classroom.php?c_id=<?php echo $course['id'] ?>">
                        <div class="col-12">
                            <div class="h4"><?php echo $course['name']; ?></div>
                            <span class="text-muted"><?php echo $course['room']; ?></span>
                        </div>
                    </a>
                </div>
                
                <?php if($_SESSION['role'] == "teacher"): ?>
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
                                    <form action="/edusign/modifyCourse" method="POST">
                                        <input type="hidden" id="course_id" name="course_id" value="<?php echo $course['id'] ?>">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="classname" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="classname" name="classname" placeholder="<?php echo $course['name'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="class" class="form-label">Salle</label>
                                                <input type="text" class="form-control" id="class" name="class" placeholder="<?php echo $course['room'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <?php foreach($classes as $class) { ?>
                                                    <input type="checkbox" name="<?php echo $class['id'] ?>" id="<?php echo $class['id'] ?>" <?php echo (in_array($user['id'], explode("-", $course['students_id'])))? 'checked' : '' ?>/>
                                                    <label for="<?php echo $class['id'] ?>"><?php echo $class['name']?></label>
                                                <?php } ?>
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
                        <a class="btn btn-danger text-white w-100 p-4" href="controller/deleteClassroom.php?c_id=<?php echo $course['id']?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
    <?php } ?>
    <?php else: ?>
        <span>Vous n'avez aucun cours</span>
    <?php endif; ?>

    <?php if($_SESSION['role'] == "teacher"): ?>
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
                                        if($user['role'] == "student"){ ?>
                                            <input type="checkbox" name="<?php echo $user['id'] ?>" id="<?php echo $user['id'] ?>"/>
                                            <label for="<?php echo $user['id'] ?>"><?php echo $user['firstname'].' '.$user['lastname'] ?></label>
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
    <?php endif; ?>
</div>

<?php require 'views/partials/footer.php'; ?>