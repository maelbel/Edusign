<?php require 'views/partials/head.php'; ?>
<?php require 'views/partials/header.php'; ?>

<div class="py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid">
            <h1 class="display-6 fw-bold">Bonjour <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?> !</h1>
            <span class="text-muted">Espace <?php echo $_SESSION['role'] ?></span>
        </div>
    </div>
    <div class="p-5 mb-4">
        <h1 class="h4">Vos cours</h1>

        <?php if(count($courses) > 0): ?>
        <?php foreach($courses as $course){ ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <form action="/course" method="GET">
                            <input type="hidden" name="course_id" id="course_id" value="<?php echo $course['id']; ?>"/>
                            <button class="btn bg-body-tertiary text-start w-100">
                                <div class="col-12">
                                    <div class="h4"><?php echo $course['name']; ?></div>
                                    <span class="text-secondary"><?php echo $course['room']; ?></span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
        <?php } ?>
        <?php else: ?>
            <span>Vous n'avez aucun cours</span>
        <?php endif; ?>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?>
<?php require 'views/partials/foot.php'; ?>