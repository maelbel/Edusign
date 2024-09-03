<?php
session_start();

include('phpqrcode/qrlib.php');


$pdo->exec("USE edusign");

// On récupère l'ancien qrcode
$sqlQuery = "SELECT token FROM `es_classroom` WHERE id='".$_REQUEST['c_id']."'";
$statement = $pdo->prepare($sqlQuery);
$statement->execute();
$oldToken = $statement->fetch();

// On change le token dans la base de donnée
$sqlQuery = "UPDATE `es_classroom` SET token='".$_REQUEST['token']."' WHERE id='".$_REQUEST['c_id']."'";
$statement = $pdo->prepare($sqlQuery);
$statement->execute();

// On crée le qr_code et le lien pour la présence
$lien = 'localhost/controller/presence.php?c_id='.$_REQUEST['c_id'].'&token='.$_REQUEST['token'];
QRcode::png($lien, './src/img/tmp/qrcode/qrcode-'.$_REQUEST['token'].'.png'); // On crée notre QR Code

// On supprime l'ancien qrcode
if(file_exists('./src/img/tmp/qrcode/qrcode-'.$oldToken['token'])){
    unlink('./src/img/tmp/qrcode/qrcode-'.$oldToken['token']);
}

echo $lien;
?>