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

    $dizi = array("elma", "armut", "muz", 3,5,8);
    echo "<pre>";
    print_r($dizi);
    echo "</pre>";
    echo "<br>$dizi[0] $dizi[1] $dizi[2] $dizi[3] $dizi[4] $dizi[5]"; 
    echo "<br>" . in_array("armut", $dizi);
    $imploded = implode("; ", $dizi);
    echo "<br>" . $imploded;
    $exploded = explode("; ",$imploded);
    echo "<pre>";
    print_r($exploded);
    echo "</pre>";

    $numbers = array(10,9,8,6,5,1,3,7);
    echo "<pre>";
    sort($numbers);
    print_r($numbers);
    echo "</pre>";

    echo "<pre>";
    rsort($numbers);
    print_r($numbers);
    echo "</pre>";

    date_default_timezone_set("Europe/Istanbul");
    echo "<br>". date("d.m.Y H:i:s");
    echo "<br>";

    foreach ($dizi as $meyve) {
        echo "<br>".$meyve;
    }
    echo "<br>";
    foreach ($dizi as $key => $value) {
        echo "<br>".$key. "=" .$value;
    
    }
    
?>
</body>

</html