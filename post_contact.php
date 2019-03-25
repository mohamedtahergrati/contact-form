<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

$mail = new PHPmailer();

// Paramètres SMTP
$mail->IsSMTP(); // activation des fonctions SMTP
$mail->SMTPAuth = true; // on l’informe que ce SMTP nécessite une autentification
$mail->SMTPSecure = 'tls'; // protocole utilisé pour sécuriser les mails 'ssl' ou 'tls'
$mail->Host = "smtp.gmail.com"; // définition de l’adresse du serveur SMTP : 25 en local, 465 pour ssl et 587 pour tls
$mail->Port = 587; // définition du port du serveur SMTP
$mail->Username = "xxxx@gmail.com"; // le nom d’utilisateur SMTP
$mail->Password = "xxxx"; // son mot de passe SMTP


$errors = [];
$emails = ['mohamedtahergrati@yahoo.fr','mohamedtahergrati@gmail.com','mohamed@yahoo.fr'];

if(!array_key_exists('name', $_POST) || $_POST['name'] == ''){
    $errors['name'] = "Vous n'avez pas renseigné votre nom";
}

if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Vous n'avez pas renseigné un email valide";
}

if(!array_key_exists('message', $_POST) || $_POST['message'] == ''){
    $errors['message'] = "Vous n'avez pas renseigné votre message";
}

if(!array_key_exists('service', $_POST) || !isset($emails[$_POST['service']])){
    $errors['service'] = "le service que vous demandez n est pas disponible";
}

session_start();

if(!empty($errors)){    
    $_SESSION['errors'] = $errors;
    $_SESSION['inputs'] = $_POST;
    header('Location: index.php');
}else{
    $_SESSION['success'] = 1;
    // Paramètres du mail
    $mail->AddAddress('mohamedtahergrati@gmail.com'); // ajout du destinataire
    $mail->From = $_POST['email']; // adresse mail de l’expéditeur
    $mail->FromName = $_POST['name']; // nom de l’expéditeur
    $mail->AddReplyTo($_POST['email'],$_POST['name']); // adresse mail et nom du contact de retour
    $mail->IsHTML(true); // envoi du mail au format HTML
    $mail->Subject = "Formulaire de contact de ".$_POST['name']."avec cet email: ".$_POST['email']; // sujet du mail
    $mail->Body = $_POST['message'];

    if(!$mail->Send()) { // envoi du mail
    echo "Mailer Error: " . $mail->ErrorInfo; // affichage des erreurs, s’il y en a
    } 
    else {
    echo  "Your mail has been sent successfully!";
    }
}
?>