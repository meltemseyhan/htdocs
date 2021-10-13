<!DOCTYPE html>
<html>

<head>
    <title> PHP Temel</title>
    <meta charset="UTF-8">
    <meta name="description" content="Meltem PHP Lesson">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="Meltem Seyhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<?php 
/*
$ch= curl_init("https://www.php.net/");
$fp= fopen("example.txt", "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);


$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.neyazilim.com/");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_REFERER, "https://www.udemy.com/");
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36");
$source = curl_exec($ch);
curl_close($ch);
echo $source;


$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/eticaret/nedmin/netling/islem.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    "userlogin"=>'1',
    "username"=>'ahmet',
    "password"=>"123456"

]);
curl_exec($ch);
curl_close($ch);
*/

$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.emrahyuksel.com.tr");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$source = curl_exec($ch);
curl_close($ch);

preg_match('@<title>(.*?)</title>@', $source, $sonuc);

print_r($sonuc);

?>

</body>

</html>