<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['text'];

$mailheader = "From:" .$name."<".$email.">";
$recipient = "albano.younes@bilgiedu.net";

mail($recipient, $subject, $message, $mailheader)
or die("Error! Information could not be sent!");

echo"Sent Successfully"

?>