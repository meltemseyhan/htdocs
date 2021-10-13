<?php
   

function seo($baslik)
{
    $metin_aranan = array("ş", "Ş", "ı", "ü", "Ü", "ö", "Ö", "ç", "Ç", "ş", "Ş", "ı", "ğ", "Ğ", "İ", "ö", "Ö", "Ç", "ç", "ü", "Ü");
    $metin_yerine_gelecek = array("s", "S", "i", "u", "U", "o", "O", "c", "C", "s", "S", "i", "g", "G", "I", "o", "O", "C", "c", "u", "U");
    $baslik = str_replace($metin_aranan, $metin_yerine_gelecek, $baslik);
    $baslik = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i", "-", $baslik);
    $baslik = strtolower($baslik);
    $baslik = preg_replace('/&.+?;/', '', $baslik);
    $baslik = preg_replace('|-+|', '-', $baslik);
    $baslik = preg_replace('/#/', '', $baslik);
    $baslik = str_replace('.', '', $baslik);
    $baslik = trim($baslik, '-');
    return $baslik;
}

function adminkontrol(){
    global $db;
    
    if (str_ends_with($_SERVER["SCRIPT_FILENAME"], "/index.php") or str_ends_with($_SERVER["SCRIPT_FILENAME"], "/login.php")) {
      return;
    }

    if(empty($_SESSION["id"]) or $_SESSION["yetki"]<>"admin") {
		Header("Location:../production/login.php?durum=yetkisizerisim");
		exit;
    }

    $statementUser = $db->prepare("SELECT * FROM user WHERE id=:id 
    and resim=:resim
    and tc=:tc
    and ad=:ad
    and mail=:mail
    and gsm=:gsm
    and adsoyad=:adsoyad
    and adres=:adres
    and il=:il
    and ilce=:ilce
    and unvan=:unvan
    and yetki=:yetki
    and durum='1'");
      $statementUser->execute(
          array(
        "id"=>$_SESSION["id"],
        "resim"=>$_SESSION["resim"],
        "tc"=>$_SESSION["tc"],
        "ad"=>$_SESSION["ad"],
        "mail"=>$_SESSION["mail"],
        "gsm"=>$_SESSION["gsm"],
        "adsoyad"=>$_SESSION["adsoyad"],
        "adres"=>$_SESSION["adres"],
        "il"=>$_SESSION["il"],
        "ilce"=>$_SESSION["ilce"],
        "unvan"=>$_SESSION["unvan"],
        "yetki"=>$_SESSION["yetki"]
          )
      );
      $rowCount =  $statementUser->rowCount();
    if($rowCount <> 1){
		Header("Location:../production/login.php?durum=yetkisizerisim");
		exit;
    } 

}

?>