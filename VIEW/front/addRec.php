<?php

include "../../CONTROLLER/rec.php";

$rec=new reclamation();
$rec->addreclamation();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'C:\xampp\htdocs\projetWeb2A\View\front\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\projetWeb2A\View\front\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\projetWeb2A\View\front\phpmailer\src\SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true ;
    $mail->Username = 'lola07517@gmail.com' ;
    $mail->Password = 'bdhv wqeu ypiu wgky' ;
    $mail->SMTPSecure = 'ssl' ;
    $mail->Port = 465 ;


    $mail->SetFrom('lola07517@gmail.com') ;

    $mail->AddAddress($_POST["email"]) ;

    $mail->isHTML(true) ;

    $mail->Subject = 'Reclamation' ;
    $mail->Body = 'Votre réclamation a été bien reçue. Vous recevrez une réponse dans les 48 heures.' ;

    $mail->send() ;

}

header('Location:../../VIEW/front/contact.php');
?>

