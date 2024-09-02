<?php if($_SESSION['role'] == 'admin'): ?>
    
    <?php 
        require 'views/partials/head.php';
        require 'views/partials/header.php';
    ?>

<a class="btn btn-secondary py-0 px-2 mb-3" href="/edusign/account"><i class="fa-solid fa-left-long"></i></a><br/>

    <span class="h4">Liste des classes</span>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">
                    <button id="addClassButton" type="button" class="btn py-0 px-1" data-bs-toggle="modal" data-bs-target="#addClassModal">
                        <i class="fa-solid fa-plus"></i>
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
                    <button id="modifyClassButton" type="button" class="btn btn-primary text-white py-2 px-3" data-bs-toggle="modal" data-bs-target="#modifyClassModal">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <a class="btn btn-danger text-white py-2 px-3" href="/edusign/deleteClass?class_id=<?php echo $class['id']?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modifyClassModal" tabindex="-1" aria-labelledby="modifyClassModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la classe</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/edusign/updateClass" method="POST">
                            <input type="hidden" id="class_id" name="class_id" value="<?php echo $class['id'] ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $class['name'] ?>">
                                </div>
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

    <!-- Modal -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer une classe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/edusign/addClass" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="addClass" id="addClass">Créer une classe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'views/partials/footer.php'; ?>

<?php else: header(Location: '/edusign/account');?>
<?php endif; ?>