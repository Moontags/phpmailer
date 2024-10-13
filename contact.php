<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


if (isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['subject']) &&
    isset($_POST['text'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $em = "Invalid email format";
        header("Location: index.php?error=$em");
        exit();
    }

    if (empty($name) || empty($subject) || empty($text)) {
        $em = "Fill out all required entry fields";
        header("Location: index.php?error=$em");
        exit();
    }

    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // correct email host
        $mail->SMTPAuth = true;
        $mail->Username = ''; // Replace with your Email
       
        $mail->Password = ''; // Replace with correct password
        $mail->SMTPSecure = "ssl"; 
        $mail->Port = 465; 
        
       
        $mail->setFrom($email, $name);
        
        $mail->addAddress(''); // Replace with correct email

      
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
           <h3>Contact Form</h3>
           <p><strong>Name</strong>: $name</p>
           <p><strong>Email</strong>: $email</p>
           <p><strong>Subject</strong>: $subject</p>
           <p><strong>Message</strong>: $text</p>
        ";

        $mail->send();
        $sm = 'Message has been sent';
        header("Location: index.php?success=$sm");
        exit();
    } catch (Exception $e) {
        $em = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: index.php?error=$em");
        exit();
    }

}
