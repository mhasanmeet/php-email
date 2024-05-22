<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// We have to require the path to the phpMailer classes
require 'PHPMailer-6.9.1/src/Exception.php';
require 'PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer-6.9.1/src/SMTP.php';

// We have to require the config.php file to use our GMAIL account for login details
require './config.php';


function sendMail($email, $subject, $message){

    // create a new phpMailer object
    $mail = new PHPMailer(true);

    // using the SMTP protocol to send the email
    $mail->isSMTP();

    // set the SMTP property to true, so we can use our GMAIL login details to send the mail
    $mail->SMTPAuth = true;

    // setting the HOST property to the MAILHOST value that we define in the config file
    $mail->Host = MAILHOST; 

    // setting the username property to the "USERNAME" that we define in the config file
    $mail->Username = USERNAME;

    // setting the password property to the "PASSWORD" that we define in the config file
    $mail->Password = PASSWORD;

    /**
     * By setting SMTPSecure to PHPMailer::ENCRYPTION_STARTTLS, we're telling PHPMailer to use 
     * STARTTLS encryption method when connecting to the SMTP server. This helps ensure that the 
     * communication between PHP application and the SMTP server is encrypted, adding a layer
     * of security to email sending process
     */
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // TCP port to connect with the GMAIL SMTP server
    $mail->Port = 587;

    // who is sending the email, we use constant from the config file
    $mail->setFrom(SEND_FROM, SEND_FROM_NAME);

    // where the mail goes
    $mail->addAddress($email);

    // Reply to method
    $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);

    /**
     * By define $mail->isHTML(true), we inform PHPMailer that the email message we're constructing 
     * will include HTML markup.
     * 
     * This is important when we want to send emails with HTML formatting, which allow us to include 
     * things like hyperlinks, images, formatting, and other HTML elements in our email content.
     */
    $mail->isHTML(true);

    // Assigning the incoming subject to the $mail->Subject property
    $mail->Subject = $subject;

    // Assigning the incoming message to the $mail->Message property
    $mail->Body = $message;

    // If email client is not support HTML content rendering, then display plain text instead
    $mail->AltBody = $message;

    // and finally we sent the email 
    if(!$mail->send()){
        return "Email not send, please try again";
    }else{
        return "success";
    }
}