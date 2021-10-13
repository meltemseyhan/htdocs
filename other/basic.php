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
    //concat
    echo "Meltem Seyhan ". "PHP öğreniyor <br>";

    //Variables
    $name = "Meltem";
    $surname = 'Seyhan';
    $age=43;

    echo $name . " " . $surname . "<hr>" . $age . "<br>";
    //0 ve 10 arasında random sayı
    $random = rand(0,10);
    echo $random;

    $text = "ben PHP öğreniyorum";
    setlocale(LC_ALL, 'UTF-8');
    echo "<br>" . $text;
    echo "<br>" . strtolower($text);
    echo "<br>" . strtoupper($text);
    echo "<br>" . ucwords($text);
    echo "<br>" . ucfirst($text);
    echo Transliterator::create("tr-Upper")->transliterate("<br>".$text);
    echo "<br> \$text değişkeninin uzunluğu : ". strlen($text);
    echo "<br>" . substr($text, 0, 2);
    
?>
</body>

</html>