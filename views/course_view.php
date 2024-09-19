<?php require 'views/partials/head.php'; ?>
<?php require 'views/partials/header.php'; ?>

<svg xmlns="http://www.w3.org/2000/svg" display="none">
    <symbol id="reload" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
    </symbol>
</svg>

<div class="row my-5 p-3 bg-body-tertiary rounded-3">
    <div class="text-muted">Name of course</div>
    <div class="h1"><?php echo $course['name']; ?></div>
    <div>Room: <?php echo $course['room'] ?></div>
</div>
<div class="row">
    <div class="col-9">
        <span class="h4">List of participants</span>
        <a class="btn" onclick="location.reload()">
            <svg class="bi" style="width: 25px; height: 25px;"><use xlink:href="#reload"/></svg>
        </a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Statut</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
                foreach($presences as $presence) {
                    $student = CourseController::getUser()->getUserById($presence['user_id']);

                    $msg_statut = ($presence['statut'])?'Present':'Absent';
                    
                    echo "<tr><td>".$student['firstname']."</td><td>".$student['lastname']."</td><td class='ms-5'>".$msg_statut."</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>

    <div class="col-3 text-center">
        <a href="" id="link-qrcode"><img style="display: none;" src="./src/img/tmp/qrcode/qrcode.png" class="img-fluid w-100" alt="qrcode" title="qrcode" id="qrcode"/></a>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?>

<script src="src/js/global.js"></script>
<script type="text/javascript">
    generateQrCode("<?php echo $course['id'] ?>")
    // setInterval(function(){
    //     generateQrCode("<?php echo $course['id'] ?>")
    // }, 5000);
</script>

<?php require 'views/partials/foot.php'; ?>