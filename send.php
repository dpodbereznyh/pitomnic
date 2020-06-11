<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require (__DIR__.'/smtp_grid/Exception.php');
require (__DIR__.'/smtp_grid/PHPMailer.php');
require (__DIR__.'/smtp_grid/SMTP.php');

$recipient_mail1 = "support@lak33.ru";
$recipient_mail2 = "vsedlyasada@lak33.ru";
$recipient_mail3 = "vsedlyasadagrount@yandex.ru";

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
	$mail->addAddress($recipient_mail1); // Email получателя
	$mail->addAddress($recipient_mail2); // Email получателя
	$mail->addAddress($recipient_mail3); // Email получателя
}


catch (Exception $e) {
	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}



$message = "<h1>Заявка с сайта питомник.вседлясада.com</h1>";
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
if (isset($_POST['link'])) {
	$message .= "Страница: ".$_POST['link']."<br />";
}
if (isset($_POST['title'])) {
	$message .= "Заголовок: ".$_POST['title']."<br />";
}
if (isset($_POST['subtitle'])) {
	$message .= "Подзаголовок: ".$_POST['subtitle']."<br />";
}

if (isset($_POST['radio1'])) {
	$message .= "Имеется ли план участка?: ".$_POST['radio1']."<br />";
}
if (isset($_POST['radio2'])) {
	$message .= "Проведена ли подготовка земли?: ".$_POST['radio2']."<br />";
}
if (isset($_POST['radio3'])) {
	$message .= "Требуется ли завоз плодородного слоя грунта?: ".$_POST['radio3']."<br />";
}
if (isset($_POST['input-size'])) {
	$message .= "Размер вашего участка (текстовое поле): ".$_POST['input-size']."<br />";
}
if (isset($_POST['input-size-check'])) {
	$message .= "Размер вашего участка (галочка что не знает): ".$_POST['input-size-check']."<br />";
}
if (isset($_POST['input-dal'])) {
	$message .= "Удаленность от города Владимир: ".$_POST['input-dal']."<br />";
}





// Письмо
$mail->isHTML(true);
$mail->Subject = 'Заявка с сайта питомник.вседлясада.com'; // Заголовок письма
$mail->Body = $message; // Текст письма
$mail->CharSet = "utf-8";
// Результат
if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo 'ok';
}
