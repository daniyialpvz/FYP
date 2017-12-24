<?php
require_once("class.phpmailer.php");
require_once("class.smtp.php");
function send_mail($name,$to,$sub,$msg){
	$mail = new PHPMailer;
	// $mail->SMTPDebug = 3;                               // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'daniyalpvz@gmail.com';                 // SMTP username
	$mail->Password = 'espiritdecorps1';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('admin@stctool.com', 'STCTool');
	$mail->addAddress($to, $name);     // Add a recipient
	$mail->addReplyTo('info@stctool.com', 'Information');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $sub;
	$mail->Body    = $msg;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	    return false;
	} else {
	    return true;
	}
}
?>