<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=id21291375_edusign;charset=utf8', 'id21291375_mael', 'Corsica2b*');

$sqlQuery = 'SELECT * FROM `es_classroom` WHERE id = '.$_REQUEST['c_id'];
$statement = $db->prepare($sqlQuery);
$statement->execute();
$classroom = $statement->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./src/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="./src/css/fontawesome/all.min.css">
        <link rel="stylesheet" href="./src/css/style.css">
    </head>
    <body>
        <a class="position-absolute btn btn-light mx-3" href="../index.php"><i class="fas fa-arrow-left"></i></a>
        <div class="container">
            <div class="row my-5 p-3 bg-body-tertiary rounded-3">
                <div class="text-muted">Nom du cours</div>
                <div class="h1"><?php echo $classroom['name']; ?></div>
                <div>Salle: <?php echo $classroom['room'] ?></div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="h4">Liste des participants 
                        <?php if($_SESSION['group_user'] == 2): ?>
                            <a class="btn btn-light border ms-2" onclick="location.reload()">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </a>
                        <?php endif; ?>
                    </div>
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
                        $sqlQuery = 'SELECT * FROM es_presence WHERE classroom_id = '.$classroom['id'];
                        $statement = $db->prepare($sqlQuery);
                        $statement->execute();
                        $presences = $statement->fetchAll();

                        foreach($presences as $presence) { 
                            $sqlQuery = 'SELECT * FROM es_user WHERE id = '.$presence['student_id'];
                            $statement = $db->prepare($sqlQuery);
                            $statement->execute();
                            $student = $statement->fetch();

                            $msg_statut = ($presence['statut'])?'Présent':'Absent';
                            
                            echo "<tr><td>".$student['name']."</td><td>".$student['lastname']."</td><td class='ms-5'>".$msg_statut."</td></tr>";
                        } 
                    ?>
                    </table>
                </div>

                <?php if($_SESSION['group_user'] == 2): ?>
                <div class="col-3 text-center">
                    <a href="" id="link-qrcode"><img style="display: none;" src="./src/img/tmp/qrcode/qrcode.png" class="img-fluid w-100" alt="qrcode" title="qrcode" id="qrcode"/></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <script src="./src/js/jquery.js"></script>
        <script src="./src/js/fontawesome/all.min.js"></script>
        <script src="./src/js/global.js"></script>
        <script type="text/javascript">
            <?php if($_SESSION['group_user'] == 2): ?>
                generateQrCode(<?php echo $classroom['id'] ?>)
                setInterval(function(){
                    generateQrCode(<?php echo $classroom['id'] ?>)
                }, 5000);
            <?php endif; ?>
        </script>
    </body>
</html>