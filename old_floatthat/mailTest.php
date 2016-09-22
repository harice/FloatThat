<?php 

include('PHPMailer-master/PHPMailerAutoload.php');

$mail = new PHPMailer;
 $mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
 $mail->Debugoutput = 'html';

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@floatthat.com';                 // SMTP username
$mail->Password = 'Host@123456';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;
$mail->isHTML(true);


$mail->setFrom($from_email="info@floatthat.com",'Floatthat');

		$mail->addReplyTo($from_email);

		$mail->addAddress($email="aranyak.banerjee@dreamztech.com");

		$mail->Subject = $Subject="Test New from .New";

		$mail->isHTML(true);

		$mail->Body = $Message="Hello .. sending from new smtp .New";
		
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
                }


?>