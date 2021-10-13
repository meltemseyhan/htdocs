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
        session_start();
 
        if (sizeof($_SESSION) > 0) {
            echo $_SESSION["name"]. " ". $_SESSION["surname"]. "<br>";

            unset($_SESSION["name"]);

            $name = isset($_SESSION["name"])? $_SESSION["name"] : "Name yok";
            echo $name. "<br>";

            session_destroy();
            echo $_SESSION["surname"]. "<br>";
        } else {
            echo "Session yok";
        }
        echo "<a href='session2.php'>Session Kontrol</a>";
    ?>
</body>

</html