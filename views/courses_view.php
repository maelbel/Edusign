<?php require 'views/partials/dashboard/head.php'; ?>
<?php require 'views/partials/dashboard/header.php'; ?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="plus" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
    </symbol>
    <symbol id="pen" viewBox="0 0 16 16">
        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
    </symbol>
    <symbol id="trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
    </symbol>
</svg>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Liste des cours</h1>
    </div>
    <div class="table-responsive small">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">
                        <button id="addCourseButton" type="button" class="btn py-0 px-1" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                            <svg class="bi"><use xlink:href="#plus"/></svg>
                        </button>
                    </th>
                    <th scope="col">Nom</th>
                    <th scope="col">Salle</th>
                    <th scope="col">Token</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
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
                        <button id="modifyCourseButton" type="button" class="btn p-0 me-2" data-bs-toggle="modal" data-bs-target="#modifyCourseModal<?php echo $course['id']?>">
                            <svg class="bi"><use xlink:href="#pen"/></svg>
                        </button>
                        <form action="/deleteCourse" method="GET" class="d-inline">
                            <input type="hidden" id="course_id" name="course_id" value="<?php echo $course['id'] ?>">
                            <button type="submit" class="btn p-0 me-2">
                                <svg class="bi"><use xlink:href="#trash"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="modifyCourseModal<?php echo $course['id']?>" tabindex="-1" aria-labelledby="modifyCourseModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le cours</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/updateCourse" method="POST">
                                <input type="hidden" id="course_id" name="course_id" value="<?php echo $course['id'] ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $course['name'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="room" class="form-label">Salle</label>
                                        <input type="text" class="form-control" id="room" name="room" value="<?php echo $course['room'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Date de début</label>
                                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo $course['start_date'];?>" step="1800">
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Date de fin</label>
                                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo $course['end_date'];?>" step="1800">
                                    </div>
                                    <?php if($classes): ?>
                                    <div class="mb-3">
                                        <label for="class" class="form-label">Sélectionnez une classe</label>
                                        <select class="form-select" id="class" name="class" required>
                                            <option value="">------</option>
                                            <?php $classIdInCourse = CoursesController::getCourseClass()->getClassIdByCourseId($course['id']); ?>
                                            <?php foreach($classes as $class) { ?>
                                                <option value="<?php echo $class['id']?>" <?php echo in_array($class['id'], $classIdInCourse) ? 'selected' : ''?>><?php echo $class['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($teachers): ?>
                                    <span>Professeur:</span>
                                    <div class="mb-3">
                                    <?php $teachersIdInClass = CoursesController::getCourseUser()->getAllTeachersIdByCourseId($course['id']); ?>
                                        <?php foreach($teachers as $teacher) { ?>
                                            <input type="checkbox" name="teachers[]" id="user_id_<?php echo $teacher['id'] ?>" value="<?php echo $teacher['id'] ?>" <?php echo in_array($teacher['id'], $teachersIdInClass)? 'checked' : '' ?>/>
                                            <label for="user_id_<?php echo $teacher['id'] ?>"><?php echo $teacher['firstname'].' '.$teacher['lastname'] ?></label>
                                        <?php } ?>
                                    </div>
                                    <?php endif; ?>
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
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un cours</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/createCourse" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Salle</label>
                        <input type="text" class="form-control" id="room" name="room" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo $time->format('Y-m-d H:i');?>" step="1800" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Date de fin</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo $time->modify('+1 hour')->format('Y-m-d H:i');?>" step="1800" required>
                    </div>
                    <?php if($classes): ?>
                    <div class="mb-3">
                        <label for="class" class="form-label">Sélectionnez une classe</label>
                        <select class="form-select" id="class" name="class" required>
                            <option value="">------</option>
                            <?php foreach($classes as $class) { ?>
                                <option value="<?php echo $class['id']?>"><?php echo $class['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <?php if($teachers): ?>
                    <span>Professeur:</span>
                    <div class="form-check mb-3">
                        <?php foreach($teachers as $teacher) { ?>
                            <input class="form-check-input" type="checkbox" name="teachers[]" id="user_id_<?php echo $teacher['id'] ?>" value="<?php echo $teacher['id'] ?>"/>
                            <label class="form-check-label" for="user_id_<?php echo $teacher['id'] ?>"><?php echo $teacher['firstname'].' '.$teacher['lastname'] ?></label>
                        <?php } ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="addCourse" id="addCourse">Créer un cours</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'views/partials/dashboard/footer.php'; ?>