<?php
$sender = "hiteric85@gmail.com";
$sendername = "HITIMANA";
$recipient = "hitimeric06@yahoo.fr";
$copyrecipient = "ukudox@gmail.com";
$hiddencopyrecipient = "hitimeric06@yahoo.fr";

$subject = "Email Test";
$content = "Text or HTML content";

$headers = "From: " . $sendername . " <" . $sender . ">\n" ;
$headers .= "Cc: " . $copyrecipient . "\nBcc: " . $hiddencopyrecipient . "\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "Return-Path: " . $sender . "\n";
$headers .= "X-Mailer: PHP/" . phpversion();

echo $headers;
$send = mail($recipient, $subject, $content, $headers);

if ($send) { echo "Email sent"; } else { echo "Email not sent"; }

?>