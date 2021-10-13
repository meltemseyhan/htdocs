<?php

try {
	$db = new PDO("mysql:host=localhost;dbname=eticaret;port=3306;charset=UTF8", "root", "root");
	//echo 'Bağlantı tamam';
} catch (PDOException $e) {
	echo $e->getMessage();
}


?>
