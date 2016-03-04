<?php
if(isset($_POST['to'])){
    $to = $_POST['to'] ;
    error_reporting(E_ALL);
    $subject = "This is a test email";
    $message = "This is a test email, please ignore.";
    if (mail($to,$subject,$message))
    {
    echo "Thank you for sending email";
    }
    else
    {
    echo "Can't send email";
    }
    }
    ?>
    <form action="" method="post">
    Email
    <input type="text" name="to" />
    <input type="submit" />
    </form>