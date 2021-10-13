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
        $_SESSION["name"] = "Meltem";
        $_SESSION["surname"] = "Seyhan";
 
        echo $_SESSION["name"]. " ". $_SESSION["surname"]. "<br>";

    ?>

    <a href="session2.php">Session Kontrol</a>;


</body>

</html