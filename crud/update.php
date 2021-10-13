<!DOCTYPE html>
<html>

<head>
    <title> CRUD İşlemleri</title>
    <meta charset="UTF-8">
    <meta name="description" content="Meltem PHP Lesson">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="Meltem Seyhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<?php
		include "connect.php";
		if (isset($_GET["durum"]) AND $_GET["durum"]=="ok") {
			echo "Update successsful";
		} elseif (isset($_GET["durum"]) AND $_GET["durum"]=="hata") {
			echo "Update failed";
		}
		$id=$_GET["id"];

		$statement = $db->prepare("SELECT * FROM bilgilerim WHERE id=:id");
		$statement->execute(
			array(
				"id"=>$id
			)
		);
		$statement->execute();
		$row=$statement->fetch(PDO::FETCH_ASSOC);

	?>
	<hr>
	<h1>Veritabanı PDO Update İşlemleri</h1>
	<form action="islem.php" method="POST">
		<input type="hidden" name="id" required value="<?php echo $row['id']?>" /><br>
		Ad <input type="text" name="ad" required value="<?php echo $row['ad']?>" /><br>
		Soyad <input type="text" name="soyad" required value="<?php echo $row['soyad']?>" /><br>
		Mail Adresiniz <input type="email" name="mail" required value="<?php echo $row['mail']?>" /><br>
		Yaşınız <input type="number" name="yas" required value="<?php echo $row['yas']?>" ><br>
		<button type="submit" name="update">Değiştir</button>
		<button type="button" action="index.php"><a href="index.php">Listeye Dön</a></button>
	</form>


</body>

</html