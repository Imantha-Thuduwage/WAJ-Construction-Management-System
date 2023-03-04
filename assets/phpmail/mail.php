<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_email($to=null,$toname=null,$subject=null,$body=null,$altbody=null) {

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 1;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'waj.construct@gmail.com';                     // SMTP username
        $mail->Password = 'kdhvirtxzlaqmnaf';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //Recipients
        $mail->setFrom('waj.construct@gmail.com', 'WAJ Construction');
	
        $mail->addAddress($to, $toname);     // Add a recipient
        // Name is optional
        $mail->addReplyTo('waj.construct@gmail.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $altbody;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
      
?>