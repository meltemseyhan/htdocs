<?php
include "connect.php";
include "function.php";
ob_start();
session_start();


if(isset($_POST["kullanicikaydet"])){
	$tc = htmlspecialchars($_POST["tc"]);
	$ad = htmlspecialchars($_POST["ad"]);
	$mail = htmlspecialchars($_POST["mail"]);
	$gsm = htmlspecialchars($_POST["gsm"]);
	$pure_password = $_POST["password"];
	$password = md5(htmlspecialchars($_POST["password"]));
	$conpassword = md5(htmlspecialchars($_POST["conpassword"]));
	$adsoyad = htmlspecialchars($_POST["adsoyad"]);
	$adres = htmlspecialchars($_POST["adres"]);
	$il = htmlspecialchars($_POST["il"]);
	$ilce = htmlspecialchars($_POST["ilce"]);
	$unvan = htmlspecialchars($_POST["unvan"]);

	if ($password <> $conpassword) {
		Header("Location:../../register.php?durum=farklisifre");
		exit;
	}
	if (strlen($pure_password)< 6) {
		Header("Location:../../register.php?durum=kisasifre");
		exit;
	}

	$statement = $db->prepare("INSERT INTO user 
	set tc=:tc, ad=:ad, mail=:mail, gsm=:gsm, password=:password, adsoyad=:adsoyad,
	adres=:adres,il=:il,ilce=:ilce,
	unvan=:unvan, yetki='user', durum='1'");
	try{
		$result = $statement->execute(
			array(
				"tc"=>$tc,
				"ad"=>$ad,
				"mail"=>$mail,
				"gsm"=>$gsm,
				"password"=>$password,
				"adsoyad"=>$adsoyad,
				"adres"=>$adres,
				"il"=>$il,
				"ilce"=>$ilce,
				"unvan"=>$unvan
			)
		);
	} catch(PDOException $e){
		if ($e->errorInfo[1]==1062) {
			Header("Location:../../register.php?durum=mevcut");
			exit;
		}
		throw $e;
	}
}
if(isset($_POST["sifreupdate"])){

	$pure_password = $_POST["password"];
	$password = md5(htmlspecialchars($_POST["password"]));
	$conpassword = md5(htmlspecialchars($_POST["conpassword"]));

	if ($password <> $conpassword) {
		Header("Location:../../hesabim.php?durum=farklisifre");
		exit;
	}
	if (strlen($pure_password)< 6) {
		Header("Location:../../hesabim.php?durum=kisasifre");
		exit;
	}

	$statement = $db->prepare("UPDATE user set password=:password");
	try{
		$result = $statement->execute(
			array(
				"password"=>$password
			)
		);
	} catch(PDOException $e){
		if ($e->errorInfo[1]==1062) {
			Header("Location:../../hesabim.php?durum=mevcut");
			exit;
		}
		throw $e;
	}

	if($result) {
		Header("Location:../../logout.php?durum=ok");
		exit;
	} else {
		Header("Location:../../hesabim.php?durum=hata");
		exit;
	}
}

if(isset($_POST["kullaniciupdate"])){
	$tc = htmlspecialchars($_POST["tc"]);
	$mail = htmlspecialchars($_POST["mail"]);
	$gsm = htmlspecialchars($_POST["gsm"]);
	$adsoyad = htmlspecialchars($_POST["adsoyad"]);
	$adres = htmlspecialchars($_POST["adres"]);
	$il = htmlspecialchars($_POST["il"]);
	$ilce = htmlspecialchars($_POST["ilce"]);
	$unvan = htmlspecialchars($_POST["unvan"]);

	$statement = $db->prepare("UPDATE user 
	set tc=:tc, mail=:mail, gsm=:gsm, adsoyad=:adsoyad,
	adres=:adres,il=:il,ilce=:ilce,
	unvan=:unvan");
	try{
		$result = $statement->execute(
			array(
				"tc"=>$tc,
				"mail"=>$mail,
				"gsm"=>$gsm,
				"adsoyad"=>$adsoyad,
				"adres"=>$adres,
				"il"=>$il,
				"ilce"=>$ilce,
				"unvan"=>$unvan
			)
		);
	} catch(PDOException $e){
		if ($e->errorInfo[1]==1062) {
			Header("Location:../../hesabim.php?durum=mevcut");
			exit;
		}
		throw $e;
	}

	if($result) {
		// Sessiondaki bilgileri de güncelle
		$_SESSION["tc"] = $tc;
		$_SESSION["mail"] = $mail;
		$_SESSION["gsm"] = $gsm;
		$_SESSION["adsoyad"] = $adsoyad;
		$_SESSION["adres"] = $adres;
		$_SESSION["il"] = $il;
		$_SESSION["ilce"] = $ilce;
		$_SESSION["unvan"] = $unvan;
		Header("Location:../../hesabim.php?durum=ok");
		exit;
	} else {
		Header("Location:../../hesabim.php?durum=hata");
		exit;
	}
}

if(isset($_POST["userlogin"])){
	$username= $_POST["username"];
	$password= md5($_POST["password"]);

	$statementUser = $db->prepare("SELECT * FROM user WHERE (mail=:username OR ad=:username) AND password=:password AND yetki='user' AND durum='1'");
	$statementUser->execute(
		array(
			"username"=>$username,
			"password"=>$password	
		)
	);

	$rowCount =  $statementUser->rowCount();

	if($rowCount == 1){
		$rowUser=$statementUser->fetch(PDO::FETCH_ASSOC);
		foreach ($rowUser as $key => $value) {
			if ($key <> "password") {
				echo "<br> $key $value";
				$_SESSION[$key] = $value;
			}
		}
		Header("Location:../../index.php?durum=ok");
		exit;
	} else {
		Header("Location:../../index.php?durum=hata");
		exit;
	}
}

if(isset($_POST["adminlogin"])){
	require_once '../../securimage/securimage.php';
	$securimage = new Securimage();
	if ($securimage->check($_POST["captcha"])==false) {
		Header("Location:../production/login.php?durum=hatacaptcha");
		exit;
	}

	$hatirla= $_POST["hatirla"];
	$mail= $_POST["mail"];
	$password= md5($_POST["password"]);

	if ($hatirla == "on") {
        setcookie("mail", $mail, strtotime("+10 days"), "/");
        setcookie("password", $_POST["password"], strtotime("+10 days"), "/");
	} else {
		setcookie("mail", $mail, strtotime("-10 days"), "/");
        setcookie("password", $_POST["password"], strtotime("-10 days"), "/");
	}

	$statementUser = $db->prepare("SELECT * FROM user WHERE (mail=:mail OR ad=:mail) AND password=:password AND yetki='admin' AND durum='1'");
	$statementUser->execute(
		array(
			"mail"=>$mail,
			"password"=>$password	
		)
	);

	$rowCount =  $statementUser->rowCount();

	if($rowCount == 1){
		ob_start();
		session_start();
		$rowUser=$statementUser->fetch(PDO::FETCH_ASSOC);
		foreach ($rowUser as $key => $value) {
			if ($key <> "password") {
				echo "<br> $key $value";
				$_SESSION[$key] = $value;
			}
		}
		Header("Location:../production/index.php");
		exit;
	} else {
		Header("Location:../production/login.php?durum=hata");
		exit;
	}
}

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

if(isset($_POST["updatelogo"])){
	$img_dir = '../../dimg/';
	$uploadName = $img_dir.rand(20000, 32000).$_FILES["logo"]["name"];
	//Dosya boyunu 10MB tan fazla ise yükleme
	if ($_FILES["logo"]["size"] > 10000000) {
		Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
		exit;
	}

	$filetype = substr($_FILES["logo"]["type"], 0, 5);
	if ($filetype <> "image") {
		Header("Location:../production/genel-ayar.php?durum=formatyanlis");
		exit;
	}

	move_uploaded_file($_FILES["logo"]["tmp_name"], $uploadName);

	$linkFromMainPage = substr($uploadName,6);
	$statement = $db->prepare("UPDATE ayar set logo=:llogo WHERE id='1'");
	$result = $statement->execute(
		array(
			"llogo"=> $linkFromMainPage
		)
	);
	if($result) {
		// Önceki resim dosyasını sil
		unlink('../../'.$_POST["eski_logo"]);
		Header("Location:../production/genel-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/genel-ayar.php?durum=hata");
		exit;
	}
}

if(isset($_POST["update"])){
	$title= $_POST["title"];
	$description= $_POST["description"];
	$keywords= $_POST["keywords"];
	$author= $_POST["author"];
	$parabirimi= $_POST["parabirimi"];

	$statement = $db->prepare("UPDATE ayar 
		set title=:ttitle, description=:ddescription, keywords=:kkeywords, author=:aauthor, parabirimi=:pparabirimi
		WHERE id='1'");
	$result = $statement->execute(
		array(
			"ttitle"=>$title,
			"ddescription"=>$description,
			"kkeywords"=>$keywords,
			"aauthor"=>$author,
			"pparabirimi"=>$parabirimi
		)
	);
	if($result) {
		Header("Location:../production/genel-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/genel-ayar.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updateiletisim"])){
	$tel= $_POST["tel"];
	$gsm= $_POST["gsm"];
	$fax= $_POST["fax"];
	$mail= $_POST["mail"];	
	$il= $_POST["il"];
	$ilce= $_POST["ilce"];
	$adres= $_POST["adres"];
	$mesai= $_POST["mesai"];	

	$statement = $db->prepare("UPDATE ayar 
		set tel=:ttel, gsm=:ggsm, fax=:ffax, mail=:mmail,
		il=:iil, ilce=:iilce, adres=:aadres, mesai=:mmesai
		WHERE id='1'");
	$result = $statement->execute(
		array(
			"ttel"=>$tel,
			"ggsm"=>$gsm,
			"ffax"=>$fax,
			"mmail"=>$mail,			
			"iil"=>$il,
			"iilce"=>$ilce,
			"aadres"=>$adres,
			"mmesai"=>$mesai		
		)
	);
	if($result) {
		Header("Location:../production/iletisim-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/iletisim-ayar.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updateapi"])){
	$maps= $_POST["maps"];
	$analytic= $_POST["analytic"];
	$zopim= $_POST["zopim"];

	$statement = $db->prepare("UPDATE ayar 
		set maps=:mmaps, analytic=:aanalytic, zopim=:zzopim
		WHERE id='1'");
	$result = $statement->execute(
		array(
			"mmaps"=>$maps,
			"aanalytic"=>$analytic,
			"zzopim"=>$zopim	
		)
	);
	if($result) {
		Header("Location:../production/api-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/api-ayar.php?durum=hata");
		exit;
	}
}
if(isset($_POST["updatesosyal"])){
	$facebook= $_POST["facebook"];
	$twitter= $_POST["twitter"];
	$google= $_POST["google"];
	$youtube= $_POST["youtube"];

	$statement = $db->prepare("UPDATE ayar 
		set facebook=:ffacebook, twitter=:ttwitter, google=:ggoogle, youtube=:yyoutube
		WHERE id='1'");
	$result = $statement->execute(
		array(
			"ffacebook"=>$facebook,
			"ttwitter"=>$twitter,
			"ggoogle"=>$google,
			"yyoutube"=>$youtube		
		)
	);
	if($result) {
		Header("Location:../production/sosyal-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/sosyal-ayar.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updatemail"])){
	$host= $_POST["host"];
	$port= $_POST["port"];
	$password= $_POST["password"];
	$user= $_POST["user"];

	$statement = $db->prepare("UPDATE ayar 
		set smtphost=:hhost, smtpport=:pport, smtppassword=:ppassword, smtpuser=:uuser
		WHERE id='1'");
	$result = $statement->execute(
		array(
			"hhost"=>$host,
			"pport"=>$port,
			"ppassword"=>$password,
			"uuser"=>$user
		)
	);

	if($result) {
		Header("Location:../production/mail-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/mail-ayar.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updateabout"])){
	$baslik= $_POST["baslik"];
	$icerik= $_POST["icerik"];
	$video= $_POST["video"];
	$vizyon= $_POST["vizyon"];
	$misyon= $_POST["misyon"];

	$statement = $db->prepare("UPDATE about 
		set baslik=:bbaslik, icerik=:iicerik, video=:vvideo, vizyon=:vvizyon, misyon=:mmisyon
		WHERE id='1'");
	$result = $statement->execute(
		array(
			"bbaslik"=>$baslik,
			"iicerik"=>$icerik,
			"vvideo"=>$video,
			"vvizyon"=>$vizyon,
			"mmisyon"=>$misyon
		)
	);

	if($result) {
		Header("Location:../production/about-ayar.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/about-ayar.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updateuser"])){
	$id = $_POST["id"];
	$tc= $_POST["tc"];
	$adsoyad= $_POST["adsoyad"];
	$mail= $_POST["mail"];
	$gsm= $_POST["gsm"];
	$durum= $_POST["durum"];

	$statement = $db->prepare("UPDATE user 
		set tc=:tc, adsoyad=:adsoyad, mail=:mail, gsm=:gsm, durum=:durum
		WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id,
			"tc"=>$tc,
			"adsoyad"=>$adsoyad,
			"mail"=>$mail,
			"gsm"=>$gsm,
			"durum"=>$durum
		)
	);

	if($result) {
		Header("Location:../production/user-edit.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:../production/user-edit.php?id=$id&durum=hata");
		exit;
	}
}

if(isset($_GET["deleteuser"])){
	$id = $_GET["deleteuser"];
	$statement = $db->prepare("DELETE FROM user WHERE id={$id}");
	$result = $statement->execute();

	if($result) {
		Header("Location:../production/users.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/users.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updatemenu"])){
	$id = $_POST["id"];
	$ust= $_POST["ust"];
	$ad= $_POST["ad"];
	$detay= $_POST["detay"];
	$url= $_POST["url"];
	$sira= $_POST["sira"];
	$seourl= seo($_POST["ad"]);
	$durum= $_POST["durum"];

	$statement = $db->prepare("UPDATE menu 
		set ust=:ust, ad=:ad, detay=:detay, url=:url, sira=:sira, seourl=:seourl, durum=:durum
		WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id,
			"ust"=>$ust,
			"ad"=>$ad,
			"detay"=>$detay,
			"url"=>$url,
			"sira"=>$sira,
			"seourl"=>$seourl,
			"durum"=>$durum
		)
	);

	if($result) {
		Header("Location:../production/menu-edit.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:../production/menu-edit.php?id=$id&durum=hata");
		exit;
	}
}

if(isset($_POST["updatekategori"])){
	$id = $_POST["id"];
	$ust= $_POST["ust"];
	$ad= $_POST["ad"];
	$sira= $_POST["sira"];
	$seourl= seo($_POST["ad"]);
	$durum= $_POST["durum"];

	$statement = $db->prepare("UPDATE kategori 
		set ust=:ust, ad=:ad, sira=:sira, seourl=:seourl, durum=:durum
		WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id,
			"ust"=>$ust,
			"ad"=>$ad,
			"sira"=>$sira,
			"seourl"=>$seourl,
			"durum"=>$durum
		)
	);

	if($result) {
		Header("Location:../production/kategori-edit.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:../production/kategori-edit.php?id=$id&durum=hata");
		exit;
	}
}

if(isset($_POST["updatebankahesap"])){
	$id = $_POST["id"];
	$adsoyad= $_POST["adsoyad"];
	$ad= $_POST["ad"];
	$iban= $_POST["iban"];
	$durum= $_POST["durum"];

	$statement = $db->prepare("UPDATE bankahesap 
		set adsoyad=:adsoyad, ad=:ad, iban=:iban, durum=:durum
		WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id,
			"adsoyad"=>$adsoyad,
			"ad"=>$ad,
			"iban"=>$iban,
			"durum"=>$durum
		)
	);

	if($result) {
		Header("Location:../production/bankahesap-edit.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:../production/bankahesap-edit.php?id=$id&durum=hata");
		exit;
	}
}

if(isset($_POST["updateurun"])){
	$id = $_POST["id"];
	$kategoriid = $_POST["kategoriid"];
	$ad= $_POST["ad"];
	$seourl= seo($_POST["ad"]);
	$fiyat= $_POST["fiyat"];
	$video= $_POST["video"];
	$detay= $_POST["detay"];
	$keyword= $_POST["keyword"];
	$stok= $_POST["stok"];
	$onecikar= $_POST["onecikar"];
	$durum= $_POST["durum"];

	$statement = $db->prepare("UPDATE urun 
		set kategoriid=:kategoriid, ad=:ad, seourl=:seourl, fiyat=:fiyat, 
		video=:video,detay=:detay, keyword=:keyword, stok=:stok, onecikar=:onecikar, durum=:durum
		WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id,
			"ad"=>$ad,
			"kategoriid"=>$kategoriid,
			"seourl"=>$seourl,
			"fiyat"=>$fiyat,
			"video"=>$video,
			"detay"=>$detay,
			"keyword"=>$keyword,
			"stok"=>$stok,
			"onecikar"=>$onecikar,
			"durum"=>$durum
		)
	);

	if($result) {
		Header("Location:../production/urun-edit.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:../production/urun-edit.php?id=$id&durum=hata");
		exit;
	}
}

if(isset($_GET["onecikar"])){
	$id = $_GET["onecikar"];

	$statement = $db->prepare("UPDATE urun set onecikar='1' WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id
		)
	);

	if($result) {
		Header("Location:../production/urun.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/urun.php?durum=hata");
		exit;
	}
}

if(isset($_GET["gerial"])){
	$id = $_GET["gerial"];

	$statement = $db->prepare("UPDATE urun set onecikar='0' WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id
		)
	);

	if($result) {
		Header("Location:../production/urun.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/urun.php?durum=hata");
		exit;
	}
}

if(isset($_GET["yorumonay"])){
	$id = $_GET["yorumonay"];

	$statement = $db->prepare("UPDATE yorum set durum='1' WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id
		)
	);

	if($result) {
		Header("Location:../production/yorum.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/yorum.php?durum=hata");
		exit;
	}
}

if(isset($_GET["yorumred"])){
	$id = $_GET["yorumred"];

	$statement = $db->prepare("UPDATE yorum set durum='0' WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id
		)
	);

	if($result) {
		Header("Location:../production/yorum.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/yorum.php?durum=hata");
		exit;
	}
}

if(isset($_GET["deletemenu"])){
	$id = $_GET["deletemenu"];
	$statement = $db->prepare("DELETE FROM menu WHERE id={$id}");
	$result = $statement->execute();

	if($result) {
		Header("Location:../production/menu.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/menu.php?durum=hata");
		exit;
	}
}

if(isset($_GET["deletekategori"])){
	$id = $_GET["deletekategori"];
	$statement = $db->prepare("DELETE FROM kategori WHERE id={$id}");
	$result = $statement->execute();

	if($result) {
		Header("Location:../production/kategori.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/kategori.php?durum=hata");
		exit;
	}
}

if(isset($_GET["deletebankahesap"])){
	$id = $_GET["deletebankahesap"];
	$statement = $db->prepare("DELETE FROM bankahesap WHERE id={$id}");
	$result = $statement->execute();

	if($result) {
		Header("Location:../production/bankahesap.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/bankahesap.php?durum=hata");
		exit;
	}
}

if(isset($_GET["deleteurun"])){
	$id = $_GET["deleteurun"];
	$statement = $db->prepare("DELETE FROM urun WHERE id={$id}");
	$result = $statement->execute();

	if($result) {
		Header("Location:../production/urun.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/urun.php?durum=hata");
		exit;
	}
}

if(isset($_POST["createmenu"])){
	$ust= $_POST["ust"];
	$ad= $_POST["ad"];
	$detay= $_POST["detay"];
	$url= $_POST["url"];
	$sira= $_POST["sira"];
	$seourl= seo($_POST["ad"]);
	$durum= $_POST["durum"];

	$statement = $db->prepare("INSERT INTO menu set ust=:ust, ad=:ad, detay=:detay, url=:url, sira=:sira, seourl=:seourl, durum=:durum");
	$result = $statement->execute(
		array(
			"ust"=>$ust,
			"ad"=>$ad,
			"detay"=>$detay,
			"url"=>$url,
			"sira"=>$sira,
			"seourl"=>$seourl,
			"durum"=>$durum
		)
	);
	if($result) {
		Header("Location:../production/menu.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/menu.php?durum=hata");
		exit;
	}
}

if(isset($_POST["createkategori"])){
	$ust= $_POST["ust"];
	$ad= $_POST["ad"];
	$sira= $_POST["sira"];
	$seourl= seo($_POST["ad"]);
	$durum= $_POST["durum"];

	$statement = $db->prepare("INSERT INTO kategori set ust=:ust, ad=:ad, sira=:sira, seourl=:seourl, durum=:durum");
	$result = $statement->execute(
		array(
			"ust"=>$ust,
			"ad"=>$ad,
			"sira"=>$sira,
			"seourl"=>$seourl,
			"durum"=>$durum
		)
	);
	if($result) {
		Header("Location:../production/kategori.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/kategori.php?durum=hata");
		exit;
	}
}

if(isset($_POST["createsiparis"])){
	$no= $_POST["no"];
	$userid= $_SESSION["id"];
	$toplam= $_POST["toplam"];
	$tip= $_POST["tip"];
	$bankahesapid= $_POST["bankahesapid"];

	$statement = $db->prepare("INSERT INTO siparis set no=:no, userid=:userid, toplam=:toplam, tip=:tip, bankahesapid=:bankahesapid, odeme='0'");
	$result = $statement->execute(
		array(
			"no"=>$no,
			"userid"=>$userid,
			"toplam"=>$toplam,
			"tip"=>$tip,
			"bankahesapid"=>$bankahesapid
		)
	);
	if (!$result) {
		Header("Location:../../odeme.php?durum=hata");
		exit;
	}

	// Ana tabloya yazdık, şimdi detayları yaz
	$siparisid = $db->lastInsertId();
	$urunidarray = $_POST["urunid"];
	$adetarray = $_POST["adet"];
	$fiyatarray = $_POST["fiyat"];
	for ($i=0; $i < count($urunidarray); $i++) { 
		$statementDetay = $db->prepare("INSERT INTO siparisdetay set siparisid=:siparisid, urunid=:urunid, adet=:adet, fiyat=:fiyat");
		$resultDetay = $statementDetay->execute(
			array(
				"siparisid"=>$siparisid,
				"urunid"=>$urunidarray[$i],
				"adet"=>$adetarray[$i],
				"fiyat"=>$fiyatarray[$i]
			)
		);
		if (!$resultDetay) {
			Header("Location:../../odeme.php?durum=hata");
			exit;
		}
	}

	// Sipariş ve detayları kaydoldu, sepeti boşalt
	$statement = $db->prepare("DELETE FROM sepet WHERE userid={$userid}");
	$result = $statement->execute();

	if(!$result) {
		Header("Location:../../odeme.php?durum=hata");
		exit;
	} 

	Header("Location:../../siparislerim.php?durum=ok");
	exit;
}

if(isset($_POST["createbankahesap"])){
	$ad= $_POST["ad"];
	$adsoyad= $_POST["adsoyad"];
	$iban= $_POST["iban"];
	$durum= $_POST["durum"];

	$statement = $db->prepare("INSERT INTO bankahesap set adsoyad=:adsoyad, ad=:ad, iban=:iban, durum=:durum");
	$result = $statement->execute(
		array(
			"ad"=>$ad,
			"adsoyad"=>$adsoyad,
			"iban"=>$iban,
			"durum"=>$durum
		)
	);
	if($result) {
		Header("Location:../production/bankahesap.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/bankahesap.php?durum=hata");
		exit;
	}
}

if(isset($_POST["createurun"])){
	$kategoriid = $_POST["kategoriid"];
	$ad= $_POST["ad"];
	$seourl= seo($_POST["ad"]);
	$fiyat= $_POST["fiyat"];
	$video= $_POST["video"];
	$detay= $_POST["detay"];
	$keyword= $_POST["keyword"];
	$stok= $_POST["stok"];
	$onecikar= $_POST["onecikar"];
	$durum= $_POST["durum"];

	$statement = $db->prepare("INSERT INTO urun 
		set kategoriid=:kategoriid, ad=:ad, seourl=:seourl, fiyat=:fiyat, 
		video=:video,detay=:detay, keyword=:keyword, stok=:stok, onecikar=:onecikar, durum=:durum");
	$result = $statement->execute(
		array(
			"ad"=>$ad,
			"kategoriid"=>$kategoriid,
			"seourl"=>$seourl,
			"fiyat"=>$fiyat,
			"video"=>$video,
			"detay"=>$detay,
			"keyword"=>$keyword,
			"stok"=>$stok,
			"onecikar"=>$onecikar,
			"durum"=>$durum
		)
	);
	if($result) {
		Header("Location:../production/urun.php?durum=ok");
		exit;
	} else {
		Header("Location:../production/urun.php?durum=hata");
		exit;
	}
}

if(isset($_POST["createyorum"])){
	$userid= $_SESSION['id'];
	$urunid= $_POST["urunid"];
	$icerik= $_POST["icerik"];
	$puan= $_POST["puan"];
	$urunseourl=$_POST["urunseourl"];

	$statement = $db->prepare("INSERT INTO yorum set icerik=:icerik, userid=:userid, urunid=:urunid, puan=:puan, durum='0'");
	$result = $statement->execute(
		array(
			"icerik"=>$icerik,
			"userid"=>$userid,
			"urunid"=>$urunid,
			"puan"=>$puan
		)
	);
	if($result) {
		Header("Location:../../urun-detay-$urunseourl.php?durum=ok");
		exit;
	} else {
		Header("Location:../../urun-detay-$urunseourl.php?durum=hata");
		exit;
	}
}

if(isset($_POST["sepeteekle"])){
	$userid= $_SESSION['id'];
	$urunid= $_POST["urunid"];
	$adet= $_POST["adet"];
	$fiyat= $_POST["fiyat"];

	$statement = $db->prepare("INSERT INTO sepet set adet=:adet, userid=:userid, urunid=:urunid, fiyat=:fiyat, durum='1'");
	$result = $statement->execute(
		array(
			"userid"=>$userid,
			"urunid"=>$urunid,
			"adet"=>$adet,
			"fiyat"=>$fiyat
		)
	);
	if($result) {
		Header("Location:../../sepet.php?durum=ok");
		exit;
	} else {
		Header("Location:../../sepet.php?durum=hata");
		exit;
	}
}
if(isset($_GET["deletesepet"])){
	$id = $_GET["deletesepet"];
	$statement = $db->prepare("DELETE FROM sepet WHERE id={$id}");
	$result = $statement->execute();

	if($result) {
		Header("Location:../../sepet.php?&durum=ok");
		exit;
	} else {
		Header("Location:../../sepet.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updatesepet"])){
	$idarray = $_POST["id"];
	$adetarray = $_POST["adet"];
	for ($i=0; $i < count($idarray); $i++) { 
		$statement = $db->prepare("UPDATE sepet set adet=:adet WHERE id=:id");
		$result = $statement->execute(
			array(
				"id"=>$idarray[$i],
				"adet"=>$adetarray[$i]
			)
		);
		if (!$result) break;
	}

	if($result) {
		Header("Location:../../sepet.php?&durum=ok");
		exit;
	} else {
		Header("Location:../../sepet.php?durum=hata");
		exit;
	}
}

if(isset($_POST["updateslider"])){

	$id = $_POST["id"];
	$ad= $_POST["ad"];
	$link= $_POST["link"];
	$sira= $_POST["sira"];
	$durum= $_POST["durum"];
	$resimyol = $_POST["eski_resimyol"];

	if(isset($_FILES["resimyol"]["name"]) and $_FILES["resimyol"]["name"]<>'') {
		$img_dir = '../../dimg/slider/';
		$uploadName = $img_dir.rand(20000, 32000).$_FILES["resimyol"]["name"];

		//Dosya boyunu 10MB tan fazla ise yükleme
		if ($_FILES["resimyol"]["size"] > 10000000) {
			Header("Location:../production/slider-edit.php?durum=dosyabuyuk");
			exit;
		}

		$filetype = substr($_FILES["resimyol"]["type"], 0, 5);
		if ($filetype <> "image") {
			Header("Location:../production/slider-edit.php?durum=formatyanlis");
			exit;
		}

		move_uploaded_file($_FILES["resimyol"]["tmp_name"], $uploadName);

		$linkFromMainPage = substr($uploadName,6);
		$resimyol= $linkFromMainPage;

	} 

	$statement = $db->prepare("UPDATE slider 
	set ad=:ad, resimyol=:resimyol, link=:link, sira=:sira, durum=:durum
	WHERE id=:id");
	$result = $statement->execute(
		array(
			"id"=>$id,
			"ad"=>$ad,
			"resimyol"=>$resimyol,
			"link"=>$link,
			"sira"=>$sira,
			"durum"=>$durum
		)
	);

	if($result) {
		// Önceki resim dosyasını sil
		if ($resimyol <> $_POST["eski_resimyol"]) {
			unlink('../../'.$_POST["eski_resimyol"]);
		}
		Header("Location:../production/slider-edit.php?id=$id&durum=ok");
		exit;
	} else {
		Header("Location:../production/slider-edit.php?id=$id&durum=hata");
		exit;
	}
}

if(isset($_GET["deleteslider"])){
	$id = $_GET["deleteslider"];

	//Önce resim dosyasını silmek lazım
	$statement = $db->prepare("SELECT resimyol FROM slider WHERE id={$id}");
	$statement->execute();
	$rowSlider=$statement->fetch(PDO::FETCH_ASSOC);
	if($rowSlider) {
		$statement = $db->prepare("DELETE FROM slider WHERE id={$id}");
		$result = $statement->execute();
		if($result) {
			unlink('../../'.$rowSlider["resimyol"]);
			Header("Location:../production/slider.php?&durum=ok");
			exit;
		} else {
			Header("Location:../production/slider.php?durum=hata");
			exit;
		}
	}
}

if(isset($_GET["deleteurunfoto"])){
	$id = $_GET["deleteurunfoto"];
	$urunid = $_GET["urunid"];

	//Önce resim dosyasını silmek lazım
	$statement = $db->prepare("SELECT resimyol FROM urunfoto WHERE id={$id}");
	$statement->execute();
	$rowUrunfoto=$statement->fetch(PDO::FETCH_ASSOC);
	if($rowUrunfoto) {
		$statement = $db->prepare("DELETE FROM urunfoto WHERE id={$id}");
		$result = $statement->execute();
		if($result) {
			unlink('../../'.$rowUrunfoto["resimyol"]);
			Header("Location:../production/urun-galeri.php?&durum=ok&id=$urunid");
			exit;
		} else {
			Header("Location:../production/urun-galeri.php?durum=hata&id=$urunid");
			exit;
		}
	}
}

if(isset($_POST["createslider"])){

	$img_dir = '../../dimg/slider/';
	$uploadName = $img_dir.rand(20000, 32000).$_FILES["resimyol"]["name"];

	//Dosya boyunu 10MB tan fazla ise yükleme
	if ($_FILES["resimyol"]["size"] > 10000000) {
		Header("Location:../production/slider.php?durum=dosyabuyuk");
		exit;
	}

	$filetype = substr($_FILES["resimyol"]["type"], 0, 5);
	if ($filetype <> "image") {
		Header("Location:../production/slider.php?durum=formatyanlis");
		exit;
	}

	move_uploaded_file($_FILES["resimyol"]["tmp_name"], $uploadName);

	$linkFromMainPage = substr($uploadName,6);

	$ad= $_POST["ad"];
	$resimyol= $linkFromMainPage;
	$link= $_POST["link"];
	$sira= $_POST["sira"];
	$durum= $_POST["durum"];

	$statement = $db->prepare("INSERT INTO slider set ad=:ad, resimyol=:resimyol, link=:link, sira=:sira, durum=:durum");
	$result = $statement->execute(
		array(
			"ad"=>$ad,
			"resimyol"=>$resimyol,
			"link"=>$link,
			"sira"=>$sira,
			"durum"=>$durum
		)
	);
	if($result) {
		Header("Location:../production/slider.php?&durum=ok");
		exit;
	} else {
		Header("Location:../production/slider.php?durum=hata");
		exit;
	}
}

if(isset($_POST["createurunfoto"])){

	$img_dir = '../../dimg/urunfoto/';
	$uploadName = $img_dir.rand(20000, 32000).$_FILES["resimyol"]["name"];
	$linkFromMainPage = substr($uploadName,6);

	$resimyol= $linkFromMainPage;
	$sira= $_POST["sira"];
	$durum= $_POST["durum"];
	$urunid= $_POST["urunid"];

	//Dosya boyunu 10MB tan fazla ise yükleme
	if ($_FILES["resimyol"]["size"] > 10000000) {
		Header("Location:../production/urun-galeri.php?durum=dosyabuyuk&id=$urunid");
		exit;
	}

	$filetype = substr($_FILES["resimyol"]["type"], 0, 5);
	if ($filetype <> "image") {
		Header("Location:../production/urun-galeri.php?durum=formatyanlis&id=$urunid");
		exit;
	}
	move_uploaded_file($_FILES["resimyol"]["tmp_name"], $uploadName);

	$statement = $db->prepare("INSERT INTO urunfoto set resimyol=:resimyol, sira=:sira, durum=:durum, urunid=:urunid");
	$result = $statement->execute(
		array(
			"resimyol"=>$resimyol,
			"sira"=>$sira,
			"durum"=>$durum,
			"urunid"=>$urunid
		)
	);
	if($result) {
		Header("Location:../production/urun-galeri.php?durum=ok&id=$urunid");
		exit;
	} else {
		Header("Location:../production/urun-galeri.php?durum=hata&id=$urunid");
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
