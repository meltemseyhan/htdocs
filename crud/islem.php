<?php
include "connect.php";
if(isset($_POST["create"])){
	$ad= $_POST["ad"];
	$soyad= $_POST["soyad"];
	$mail= $_POST["mail"];
	$yas= $_POST["yas"];

	echo "<br> $ad $soyad $mail $yas <br>";

	$statement = $db->prepare("INSERT INTO bilgilerim set ad=:aad, soyad=:ssoyad, mail=:mmail, yas=:yyas");
	$result = $statement->execute(
		array(
			"aad"=>$ad,
			"ssoyad"=>$soyad,
			"mmail"=>$mail,
			"yyas"=>$yas
		)
	);
	if($result) {
		//echo "kayıt başarılı";
		Header("Location:index.php?durum=ok");
		exit;
	} else {
		//echo "kayıt başarısız";
		Header("Location:index.php?durum=hata");
		exit;
	}
}

if(isset($_POST["update"])){
	$ad= $_POST["ad"];
	$soyad= $_POST["soyad"];
	$mail= $_POST["mail"];
	$yas= $_POST["yas"];
	$id=$_POST["id"];

	echo "<br> $ad $soyad $mail $yas <br>";

	$statement = $db->prepare("UPDATE bilgilerim set ad=:aad, soyad=:ssoyad, mail=:mmail, yas=:yyas WHERE id=:iid");
	$result = $statement->execute(
		array(
			"aad"=>$ad,
			"ssoyad"=>$soyad,
			"mmail"=>$mail,
			"yyas"=>$yas,
			"iid"=>$id
		)
	);
	if($result) {
		Header("Location:update.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:update.php?id=$id&durum=hata");
		exit;
	}
}
if(isset($_GET["id"])){
	$id=$_GET["id"];

	$statement = $db->prepare("DELETE FROM bilgilerim WHERE id=:iid");
	$result = $statement->execute(
		array(
			"iid"=>$id
		)
	);
	if($result) {
		Header("Location:index.php?durum=ok");
		exit;
	} else {
		Header("Location:index.php?durum=hata");
		exit;
	}
}
?>
