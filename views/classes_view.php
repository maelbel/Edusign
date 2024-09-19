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
        <h1 class="h2">Liste des classes</h1>
    </div>
    <div class="table-responsive small">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">
                        <button id="addClassButton" type="button" class="btn py-0 px-1" data-bs-toggle="modal" data-bs-target="#addClassModal">
                            <svg class="bi"><use xlink:href="#plus"/></svg>
                        </button>
                    </th>
                    <th scope="col">Nom</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($classes as $class){ ?>
                <tr>
                    <th scope="row"><?php echo $class['id']; ?></th>
                    <td><?php echo $class['name']; ?></td>
                    <td>
                        <button id="modifyClassButton" type="button" class="btn p-0 me-2" data-bs-toggle="modal" data-bs-target="#modifyClassModal<?php echo $class['id']?>">
                            <svg class="bi"><use xlink:href="#pen"/></svg>
                        </button>
                        <form action="/deleteClass" method="GET" class="d-inline">
                            <input type="hidden" id="class_id" name="class_id" value="<?php echo $class['id'] ?>">
                            <button type="submit" class="btn p-0 me-2">
                                <svg class="bi"><use xlink:href="#trash"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="modifyClassModal<?php echo $class['id']?>" tabindex="-1" aria-labelledby="modifyClassModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la classe</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/updateClass" method="POST">
                            <input type="hidden" id="class_id" name="class_id" value="<?php echo $class['id'] ?>">
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $class['name'] ?>">
                                    </div>
                                    <?php if($students): ?>
                                    <span>Élèves:</span>
                                    <div class="mb-3">
                                        <?php $studentsIdInClass = ClassesController::getClassUser()->getAllStudentsIdByClassId($class['id']); ?>
                                        <?php foreach($students as $student) { ?>
                                            <input type="checkbox" name="students[]" id="user_id_<?php echo $student['id'] ?>" value="<?php echo $student['id'] ?>" <?php echo in_array($student['id'], $studentsIdInClass)? 'checked' : '' ?>/>
                                            <label for="user_id_<?php echo $student['id'] ?>"><?php echo $student['firstname'].' '.$student['lastname'] ?></label><br/>
                                        <?php } ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary" name="modifyClass" id="modifyClass">Modifier la classe</button>
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
<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Créer une classe</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/createClass" method="POST">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <?php if($students): ?>
                    <span>Élèves:</span>
                    <div class="mb-3">
                        <?php foreach($students as $student) { ?>
                            <input type="checkbox" name="students[]" id="user_id_<?php echo $student['id'] ?>" value="<?php echo $student['id'] ?>"/>
                            <label for="user_id_<?php echo $student['id'] ?>"><?php echo $student['firstname'].' '.$student['lastname'] ?></label>
                        <?php } ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="createClass" id="createClass">Créer la classe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'views/partials/dashboard/footer.php'; ?>