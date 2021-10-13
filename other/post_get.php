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
        $ad= isset($_POST["ad"])? $_POST["ad"]:'';
        $soyad = isset($_POST["soyad"])? $_POST["soyad"]:'';
        echo "<br>". $ad . " " . $soyad;

    ?>
    <form action="" method="POST">
        Ad <input type="text" name="ad" placeholder="Adınızı giriniz"/>
        Soyad <input type="text" name="soyad" placeholder="Soyadınızı giriniz"/>
        <input type="submit" name="btnSubmit" value="Formu Gönder"/>
    </form>
    <form action="get.php" method="GET">
        Ad <input type="text" name="ad" placeholder="Adınızı giriniz"/>
        Soyad <input type="text" name="soyad" placeholder="Soyadınızı giriniz"/>
        <input type="submit" name="btnSubmit" value="Formu Gönder"/>
    </form>

</body>

</html