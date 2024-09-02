<?php if($_SESSION['role'] == 'admin'): ?>
    
    <?php 
        require 'views/partials/head.php';
        require 'views/partials/header.php';
    ?>

    <a class="btn btn-secondary py-0 px-2 mb-3" href="/edusign/account"><i class="fa-solid fa-left-long"></i></a><br/>
    
    <span class="h4">Liste des comptes</span>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">
                    <button id="addAccountButton" type="button" class="btn py-0 px-1" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </th>
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
                <td><?php echo $user['firstname']; ?></td>
                <td><?php echo $user['lastname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <button id="modifyAccountButton" type="button" class="btn btn-primary text-white py-2 px-3" data-bs-toggle="modal" data-bs-target="#modifyAccountModal">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <a class="btn btn-danger text-white py-2 px-3" href="/edusign/deleteUser?user_id=<?php echo $user['id']?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modifyAccountModal" tabindex="-1" aria-labelledby="modifyAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le compte</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/edusign/updateUser" method="POST">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['id'] ?>">
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="firstname" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname'] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="lastname" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="role">Groupe:</label>
                                    <select name="role" id="role">
                                        <option value="viewer">Visiteur</option>
                                        <option value="student">Étudiant</option>
                                        <option value="admin">Administrateur</option>
                                        <option value="teacher">Professeur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" name="modifyAccount" id="modifyAccount">Modifier le compte</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un compte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/edusign/register" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
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
                            <label for="role">Groupe:</label>
                            <select name="role" id="role">
                                <option value="viewer">Visiteur</option>
                                <option value="student">Étudiant</option>
                                <option value="admin">Administrateur</option>
                                <option value="teacher">Professeur</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="createAccount" id="createAccount">Créer un compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'views/partials/footer.php'; ?>

<?php else: header(Location: '/edusign/account');?>
<?php endif; ?>