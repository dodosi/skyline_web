<?php
function send_email($receiver, $subject, $message){
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->IsHTML(true);
        $mail->setFrom('info@skylineautoservices.co', 'Skylineautoservices Ltd');
        $addr = explode(',',$receiver);
        
        foreach ($addr as $ad) {
            $mail->AddAddress(trim($ad), 'Receiver');       
        }
        
        // $mail->addAddress($receiver, 'Receiver');
        $mail->Subject = $subject;
        $mail->Body = $message;
        if (!$mail->send()) {
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            // echo 'Message has been sent.';
        }
}
?>