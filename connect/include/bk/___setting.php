<?php

function getPHPmailer(){
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->CharSet	= "UTF-8";

	$mail->isHTML(true); 

	$mail->SMTPDebug = 1;
	$mail->timeout = 3600;
	$mail->Debugoutput = 'html';

	$mail->Host = "smtp.gmail.com"; // SMTP server
	$mail->Port = 465; // พอร์ท
	$mail->SMTPSecure = "ssl";
	$mail->SMTPAuth   = true; 

	$mail->Username = "admin@syncompany.co.th"; // account SMTP
	$mail->Password = "!Q2w3e4r5t6y7u"; // รหัสผ่าน SMTP		


	// $mail->From = "admin@syncompany.co.th";
	// $mail->FromName = "HisoCloset.com";

	return $mail;
}



?>