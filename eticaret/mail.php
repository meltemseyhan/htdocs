<?php 
	ob_start();
	session_start();
	include './nedmin/netling/connect.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;	
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	if ($_POST["toplam"] != $_POST["islem"]) {
		echo "bot kontrolü";
		exit;
	}
	$adsoyad=$_POST["adsoyad"];
	$custmail=$_POST["mail"];
	$mailcontent=$_POST["text"];

	$statement = $db->prepare("SELECT * FROM ayar WHERE id='1'");
	$statement->execute();
	//Tek satır bekliyoruz
	$row=$statement->fetch(PDO::FETCH_ASSOC);

	$mail = new PHPMailer(true);
    $mail->isSMTP();   
	$mail->CharSet  = "SET NAMES UTF-8";
	$mail->Host     = $row["smtphost"];
	$mail->Port     = $row["smtpport"];
	$mail->SMTPAuth = true;
	$mail->Username = $row["smtpuser"];
	$mail->Password = $row["smtppassword"];
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 

	$mail->From     = $row["smtpuser"];
	$mail->FromName = $adsoyad;
	$mail->Subject  = $adsoyad.' - İletişim Formu';
	$mail->Body     = $adsoyad. '    ' . $custmail . '    ' . $mailcontent;
    $mail->addAddress($row["mail"]);
	$mail->addReplyTo($custmail);


    if(!$mail->send()) {
        echo "Şu adrese mail gönderilriken hata oluştu: " . $row["mail"] . "<br>";
		echo $mail->ErrorInfo;
	}

	echo "Mail gönderildi.";

?>
	