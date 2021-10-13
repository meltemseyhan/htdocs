<?php 
include 'header.php';
?>
	<head>
    	<title><?php echo $row['title']?> - Üye Kayıt</title>
	</head>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap">
					<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bread"><a href="#">Anasayfa</a> &rsaquo; Kayıt</div>
							<div class="bigtitle">Bilgileriniz</div>
						</div>
							<?php if(isset($_GET["durum"]) AND $_GET["durum"] == "ok") {?>
							<div class="col-md-3 col-md-offset-5">
								<button class="btn btn-default btn-info btn-lg">Kullanıcı kayıt işlemi başarılı</button>
							</div>
							<?php } elseif (isset($_GET["durum"]) ) {
							switch ($_GET["durum"]) {
								case 'farklisifre':
									$hata = "Kayıt işlemi başarısız: Girilen şifreler farklı";
									break;
								case 'kisasifre':
									$hata = "Kayıt işlemi başarısız: Şifreniz en az 6 karakter uzunluğunda olmalı";
									break;	
								case 'mevcut':
									$hata = "Bu kullanıcı adı ya da e-posta daha önce kullanılmış";
									break;					
								default:
									$hata = "Kayıt işlemi başarısız";
									break;
							}
							?>
							<div class="col-md-3 col-md-offset-5">
								<button class="btn btn-default btn-danger btn-lg"><?php echo $hata?></button>
							</div>
							<?php } ?>	
					</div>
					</div>
				</div>
			</div>
		</div>
		
		<form class="form-horizontal checkout" action="nedmin/netling/islem.php" method="POST" role="form">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group dob">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="adsoyad" placeholder="Ad Soyad">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="tc" placeholder="TC Kimlik Numarası">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="mail" class="form-control" name="mail" placeholder="E-posta">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="gsm" placeholder="Cep Telefonu">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-6">
							<input type="text" class="form-control" name="ad" placeholder="Kullacını Adı">
						</div>
						<div class="col-sm-6">
							
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-6">
							<input type="password" class="form-control" name="password" placeholder="Şifre">
						</div>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="conpassword" placeholder="Şifreyi Tekrar Giriniz">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="unvan" placeholder="Ünvan">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="adres" placeholder="Adres">
						</div>
					</div>
					<div class="form-group dob">
						<div class="col-sm-6">
							<input type="text" class="form-control" name="il" placeholder="il">
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="ilce" placeholder="ilce">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button name="kullanicikaydet" class="btn btn-default btn-red">Kayıt Ol</button>
				</div>
			</div>
		</form>
		<div class="spacer"></div>
	</div>
	<?php include 'footer.php';?>