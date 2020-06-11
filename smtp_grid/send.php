<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require (__DIR__.'/smtp_grid/Exception.php');
require (__DIR__.'/smtp_grid/PHPMailer.php');
require (__DIR__.'/smtp_grid/SMTP.php');

$recipient_mail = "test.doska13@yandex.ru"; 

$mail = new PHPMailer;
try {
	$mail->isSMTP(); 
	$mail->Host = 'smtp.yandex.ru'; 
	$mail->SMTPAuth = true; 
	$mail->Username = 'no-reply@gridstudio.ru'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
	$mail->Password = 'iCd9D6mRR59j4VuJ'; // Ваш пароль
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->setFrom('no-reply@gridstudio.ru'); // Ваш Email
	$mail->addAddress($recipient_mail); // Email получателя
}


catch (Exception $e) {
	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}




$message = "<h1>Заявка с сайта gridstudio.ru</h1>";
if (isset($_POST['name'])) {
	$message .= "Имя: ".$_POST['name']."<br />";
}
if (isset($_POST['phone'])) {
	$message .= "Телефон: ".$_POST['phone']."<br />";
}
if (isset($_POST['email'])) {
	$message .= "Почта: ".$_POST['email']."<br />";
}

if (isset($_POST['comment'])) {
	$message .= "Описание: ".$_POST['comment']."<br />";
}

if (isset($_POST['title'])) {
	$message .= "Заголовок: ".$_POST['title']."<br />";
}
if (isset($_POST['subtitle'])) {
	$message .= "Подзаголовок: ".$_POST['subtitle']."<br />";
}



// Письмо
$mail->isHTML(true); 
$mail->Subject = 'Заявка с сайта gridstudio.ru'; // Заголовок письма
$mail->Body = $message; // Текст письма
// Результат
if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo 'ok';
}
?>


// mail($recipient_mail, 'Заявка с сайта gridstudio.ru', $message, $headers);

?>