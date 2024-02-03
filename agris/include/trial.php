<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



require_once "vendor/autoload.php";






//PHPMailer Object
$mail = new PHPMailer(); //Argument true in constructor enables exceptions


$mail->isSMTP();
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'minatech62@gmail.com';
$mail->Password = 'gnjisngztrxpbxzi';
//$mail->SMTPDebug = 'SMTP::DEBUG_SERVER';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;


$mail->setFrom('minatech62@gmail.com', 'Imran');
$mail->addReplyTo('minatech62@gmail.com', 'imran');
$mail->addAddress('imranhayredin89@gmail.com','imran');
//$mail->addCC('cc1@example.com', 'Elena');
//$mail->addBCC('bcc1@example.com', 'Alex');


//$mail->AddBCC('bcc2@example.com', 'Anna');
//$mail->AddBCC('bcc3@example.com', 'Mark');
$mail->Subject = 'confirmation';
$mail->isHTML(true);


$mailContent = "<h1>This is your confirmation password</h1>
    <h3>$x</h3>";
$mail->Body = $mailContent;







if($mail->send()){
  
    echo 'Message has been sent';
    //header('location:auth.php');
    //header('location:auth.php');

}else{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}



?>
