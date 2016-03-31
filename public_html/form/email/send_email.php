<?php
 
require 'PHPMailer-master/PHPMailerAutoload.php'; 

$mail = new PHPMailer; 

$mail->setFrom('michael@automationlab.com.au', 'Mailer');
$mail->addAddress('mrjesuserwinsuarez@gmail.com', 'Jesus User');     // Add a recipient 

$mail->addReplyTo('michael@automationlab.com.au', 'Information'); 

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}