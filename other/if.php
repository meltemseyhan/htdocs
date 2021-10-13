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
        //Kısa if kullanımı
        $sayi = 3;
        echo $sayi == 3? "üç": "üç değil";

        $meyve = "Armut";
    ?>
    <select>
        <option <?php echo $meyve=='Elma'? 'selected':''?>>Elma</option>
        <option <?php echo $meyve=='Armut'? 'selected':''?>>Armut</option>
</select>
</body>

</html