<!DOCTYPE html>
<html>

<head>
    <title> PHP Temel</title>
    <meta charset="UTF-8">
    <meta name="description" content="Meltem PHP Lesson">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="Meltem Seyhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Yönlendirme Kodu-->
    <meta http-equiv="refresh" content="300;URL=cek.php">
</head>

<body>

    <?php
    $veri = file_get_contents("https://www.udemy.com/course/sifirdan-ileri-seviye-web-programlama-html-php-pdo-mysql");
    preg_match_all('@<div data-purpose="enrollment" class="">(.*?)öğrenci@si', $veri, $sonuc);

    //echo '<pre>';
    //print_r($sonuc);

    $ogrencisayisi = $sonuc[1][0];

    //echo $ogrencisayisi;
    //echo '</pre>';
    ?>

    <br>
    <br>
    <b sytle="font-size:400px;"><center><?php echo $ogrencisayisi?></center></b>

    <?php 
    $dosya = "veri.txt";
    $latest=0;
    if (file_exists($dosya) && filesize($dosya)>0) {
        $handle = fopen($dosya,"r");
        $icerik = fread($handle, filesize($dosya));
        $listele = explode(PHP_EOL, $icerik);
        fclose($handle);
        $latest = end($listele);
    }

    if ($ogrencisayisi <> $latest) {
        echo "<h1><center>YENİ ÖĞRENCİ VAR</center></h1>";
        $handle = fopen($dosya,"a");
        fwrite($handle, $ogrencisayisi);
        fclose($handle);
    } else {
        echo "<h1><center>YENİ ÖĞRENCİ YOK</center></h1>";
    }

    ?>
</body>

</html>