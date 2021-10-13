<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=udemy;port=3306;charset=UTF8", "root", "root");

} catch (PDOException $e) {
	echo $e->getMessage();
}


?>
