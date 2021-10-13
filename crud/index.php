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
			echo "DB işlemi başarılı";
		} elseif (isset($_GET["durum"]) AND $_GET["durum"]=="hata") {
			echo "DB işlemi hatalı";
		}
	?>
	<hr>
	<h1>Veritabanı PDO Kayıt İşlemleri</h1>
	<form action="islem.php" method="POST">
		Ad <input type="text" name="ad" required placeholder="Adınızı giriniz..."/><br>
		Soyad <input type="text" name="soyad" required placeholder="Soyadınızı giriniz..."/><br>
		Mail Adresiniz <input type="email" name="mail" required placeholder="Mail adresinizi giriniz..."/><br>
		Yaşınız <input type="number" name="yas" required placeholder="Yaşınızı giriniz..."/><br>
		<button type="submit" name="create">Ekle</button><br>
	</form>

	<br>
	<h4>Kayıt Listesi</h4>
	<hr>

	<?php
	$statement = $db->prepare("SELECT * FROM bilgilerim");
	$statement->execute();
	?>

	<table style="width:60%" border="1">
		<tr>
			<th>Sıra No</th>
			<th>ID</th>
			<th>Ad</th>
			<th>Soyad</th>
			<th>Mail</th>
			<th>Yas</th>
			<th>Zaman</th>
			<th>İşlemler</th>
		</tr>
		<?php
		$sira = 1;
		while ($row=$statement->fetch(PDO::FETCH_ASSOC)) {
		?>
		<tr>
			<td><?php echo $sira++?></td>
			<td><?php echo $row['id']?></th>
			<td><?php echo $row['ad']?></td>
			<td><?php echo $row['soyad']?></td>
			<td><?php echo $row['mail']?></td>
			<td><?php echo $row['yas']?></td>
			<td><?php echo $row['zaman']?></td>
			<td align="center"><a href="islem.php?id=<?php echo $row['id']?>">Sil</a>  <a href="update.php?id=<?php echo $row['id']?>">Düzenle</a></td>
		</tr>
		<?php 
		} 
		?>
	</table>

</body>

</html