<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . '/vendors/PHPMailer/src/Exception.php';
require dirname(__DIR__) . '/vendors/PHPMailer/src/PHPMailer.php';
require dirname(__DIR__) . '/vendors/PHPMailer/src/SMTP.php';

function enviar_email($from, $to, $subject, $body){
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Host = 'smtp.hostinger.com';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = 'contato@cursohacker.com.br';
	$mail->Password = 'Tubular11el!';
	$mail->setFrom($from, $from);
	$mail->addReplyTo($from, $from);
	$mail->addAddress($to, $to);
	$mail->Subject = $subject;
	$mail->Body = $body;
	if (!$mail->send()) {
		return false;
	} else {
		return true;
	}

}

enviar_email("contato@cursohacker.com.br", "wellington.aied@gmail.com", "Recuperar acesso", "um corpo")
?>