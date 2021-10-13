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

        echo $_COOKIE["adsoyad"]. "<br>";
        echo $_COOKIE["il"]. "<br>";

        //Cookie silme
        setcookie("adsoyad", "", strtotime("-1 hours"));
        
        echo $_COOKIE["adsoyad"]. "<br>";
        echo $_COOKIE["il"]. "<br>";
    ?>


</body>

</html