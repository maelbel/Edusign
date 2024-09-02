<?php if($_SESSION['role'] == 'admin'): ?>
    
    <?php 
        require 'views/partials/head.php';
        require 'views/partials/header.php';
    ?>

<a class="btn btn-secondary py-0 px-2 mb-3" href="/edusign/account"><i class="fa-solid fa-left-long"></i></a><br/>

    <span class="h4">Liste des cours</span>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">
                    <button id="addCourseButton" type="button" class="btn py-0 px-1" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </th>
                <th scope="col">Nom</th>
                <th scope="col">Salle</th>
                <th scope="col">Token</th>
                <th scope="col">Date début</th>
                <th scope="col">Date fin</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($courses as $course){ ?>
            <tr>
                <th scope="row"><?php echo $course['id']; ?></th>
                <td><?php echo $course['name']; ?></td>
                <td><?php echo $course['room']; ?></td>
                <td><?php echo $course['token']; ?></td>
                <td><?php echo $course['start_date']; ?></td>
                <td><?php echo $course['end_date']; ?></td>
                <td>
                    <button id="modifyCourseButton" type="button" class="btn btn-primary text-white py-2 px-3" data-bs-toggle="modal" data-bs-target="#modifyCourseModal">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <a class="btn btn-danger text-white py-2 px-3" href="/edusign/deleteCourse?course_id=<?php echo $course['id']?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modifyCourseModal" tabindex="-1" aria-labelledby="modifyCourseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le cours</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/edusign/updateCourse" method="POST">
                            <input type="hidden" id="course_id" name="course_id" value="<?php echo $course['id'] ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $course['name'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="room" class="form-label">Salle</label>
                                    <input type="text" class="form-control" id="room" name="room" value="<?php echo $course['room'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Date de début</label>
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo $course['start_date'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Date de fin</label>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo $course['end_date'] ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" name="modifyCourse" id="modifyCourse">Modifier le cours</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un cours</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/edusign/addCourse" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="room" class="form-label">Salle</label>
                            <input type="text" class="form-control" id="room" name="room">
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Date de début</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo $time->format('Y-m-d H:i');?>" step="1800">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Date de fin</label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo $time->modify('+1 hour')->format('Y-m-d H:i');?>" step="1800">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="addCourse" id="addCourse">Créer un cours</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'views/partials/footer.php'; ?>

<?php else: header(Location: '/edusign/account');?>
<?php endif; ?>