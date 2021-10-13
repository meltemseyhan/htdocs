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
        $ad= isset($_GET["ad"])? $_GET["ad"]:'';
        $soyad = isset($_GET["soyad"])? $_GET["soyad"]:'';
        echo "<br>". $ad . " " . $soyad;
      

    ?>

</body>

</html