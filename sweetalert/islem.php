<?php 
//echo $_POST["username"]. " ". $_POST["password"];
$response["status"] = "success";
$response["message"] = "Kullanıcı: " . $_POST["username"]. " Şifre: ". $_POST["password"];

echo json_encode($response);
?>