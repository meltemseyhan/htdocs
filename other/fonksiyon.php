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

    $sayi2 = 20;

    function topla($sayi1) {
        global $sayi2;
        return $sayi1 + $sayi2;
    }
    echo topla(13); //33
    echo "<br>";

    function topla2($sayi1, $sayi2="10") {
        return $sayi1 + $sayi2;
    }
    echo topla2(13);    //23
    echo "<br>";
    echo topla2(13, 15); //28
    echo "<br>";

    //Recursion
    $sonuc = 1;
    function faktoriyel($sayi){
        global $sonuc;
        if($sayi>1){
            $sonuc=$sayi* $sonuc;
            faktoriyel(--$sayi);
        }
        return $sonuc;
    }
    echo faktoriyel(3);

    //Fonksiyon var mı diye bakma
    echo "<br>".function_exists("faktoriyel");

    //Tüm PHP fonksiyonlarının listesi
    $allfunctions = get_defined_functions();
    echo "<pre>";
    print_r($allfunctions);
    echo"</pre>";
 
    ?>
</body>

</html