<?php
//use PHPMailer\src\PHPMailer;
//use PHPMailer\src\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



require_once "vendor/autoload.php";

// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);

$name="";
$message="";
$email="";
$output="";

if(isset($_POST['submit'])){
    if(isset($_POST['name']) && isset($_POST['message']) && isset($_POST['subject']) && isset($_POST['email'])) {
        $name=$_POST['name'];
        $subject=$_POST['subject'];
        $message=$_POST['message'];
        $email=$_POST['email'];
        


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


$mail->setFrom($email, $name);
$mail->addReplyTo('minatech62@gmail.com', 'imran');
$mail->addAddress('alazar.damena01@gmail.com','Alazar Damena');
//$mail->addCC('cc1@example.com', 'Elena');
//$mail->addBCC('bcc1@example.com', 'Alex');


//$mail->AddBCC('bcc2@example.com', 'Anna');
//$mail->AddBCC('bcc3@example.com', 'Mark');
$mail->Subject = $subject;
$mail->isHTML(true);


$mailContent = "<p> A new message was sent from you website. It is from <b>".$name."</b> with an email address <b>" . $email."</b> The subject is: <b>" . $subject."</b> The message is as follows:</br> <i>".$message."</i>";
$mail->Body = $mailContent;







if($mail->send()){
  
    $output= 'Message has been sent';
    header('location:../index.html');
    //header('location:auth.php');

}else{
    $output= 'Message could not be sent.';
    $output+= 'Mailer Error: ' . $mail->ErrorInfo;
}


}
}
?>
