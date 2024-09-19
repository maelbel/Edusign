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
        <h1 class="h2">Liste des comptes</h1>
    </div>
    <div class="table-responsive small">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">
                        <button id="addAccountButton" type="button" class="btn py-0 px-1" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                            <svg class="bi"><use xlink:href="#plus"/></svg>
                        </button>
                    </th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
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
                        <button id="modifyAccountButton" type="button" class="btn p-0 me-2" data-bs-toggle="modal" data-bs-target="#modifyAccountModal<?php echo $user['id']?>">
                            <svg class="bi"><use xlink:href="#pen"/></svg>
                        </button>
                        <form action="/deleteUser" method="GET" class="d-inline">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['id'] ?>">
                            <button type="submit" class="btn p-0 me-2">
                                <svg class="bi"><use xlink:href="#trash"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="modifyAccountModal<?php echo $user['id']?>" tabindex="-1" aria-labelledby="modifyAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier le compte</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/updateUser" method="POST">
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
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="role">Groupe:</label>
                                        <?php $plan = array('viewer' => 'Visiteur','student'=>'Étudiant','teacher'=>'Professeur','admin'=>'Administrateur' ); ?>
                                        <select name="role" id="role">
                                            <?php foreach ($plan as $key => $value) { ?>
                                            <option value="<?php echo $key;?>" <?php echo ($key ==  $user['role']) ? 'selected' : '';?>><?php echo $value;?></option>
                                            <?php } ?>
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
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un compte</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/register" method="POST">
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
                            <option value="teacher">Professeur</option>
                            <option value="admin">Administrateur</option>
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

<?php require 'views/partials/dashboard/footer.php'; ?>