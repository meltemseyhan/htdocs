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
        setcookie("adsoyad", "Meltem Seyhannn", time()+3600);
        setcookie("il", "istanbul", strtotime("+1 hours"));
        echo $_COOKIE["adsoyad"];

    ?>

    <a href="cookie2.php">Cookie Kontrol</a>;


</body>

</html