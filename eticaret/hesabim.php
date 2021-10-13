<?php 
include 'header.php';
?>	
  	<head>
    	<title><?php echo $row['title']?> - Üyelik Bilgileriniz</title>
	</head>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap">
					<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Bilgileriniz</div>
						</div>
							<?php if(isset($_GET["durum"]) AND $_GET["durum"] == "ok") {?>
							<div class="col-md-3 col-md-offset-5">
								<button class="btn btn-default btn-info btn-lg">Bilgileriniz başarıyla değiştirildi</button>
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
									$hata = "Bu e-posta daha önce kullanılmış";
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
				<div class="col-md-12">
					<div class="form-group dob">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Şifre<span class="required">*</span>
                        </label>
						<div class="col-md-3 col-sm-3 col-xs-6">
							<input type="password" class="form-control" name="password" placeholder="Şifre">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
							<input type="password" class="form-control" name="conpassword" placeholder="Şifreyi Tekrar Giriniz">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<button name="sifreupdate" class="btn btn-default btn-red">Şifre Değiştir</button>
				</div>
			</div>
		</form>

		<div class="spacer"></div>

		<form class="form-horizontal checkout" action="nedmin/netling/islem.php" method="POST" role="form">
			<div class="row">
				<div class="form-group dob">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="adsoyad">Ad Soyad<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="adsoyad" value="<?php echo $_SESSION["adsoyad"]?>">
					</div>
				</div>
				<div class="form-group dob">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tc">TC Kimlik No<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="tc" value="<?php echo $_SESSION["tc"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="mail">E-Posta Adresi<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="mail" class="form-control" name="mail" value="<?php echo $_SESSION["mail"]?>">
					</div>
				</div>
				<div class="form-group dob">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="gsm">Cep Telefonu<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="gsm" value="<?php echo $_SESSION["gsm"]?>">
					</div>
				</div>
				<div class="form-group dob">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="gsm">Kullanıcı Adı<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" readonly class="form-control" name="ad" value="<?php echo $_SESSION["ad"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="unvan">Ünvan<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="unvan" value="<?php echo $_SESSION["unvan"]?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="adres">Adres<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="adres" value="<?php echo $_SESSION["adres"]?>">
					</div>
				</div>
				<div class="form-group dob">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="il">İl<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="il" value="<?php echo $_SESSION["il"]?>">
					</div>
				</div>
				<div class="form-group dob">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ilce">İlçe<span class="required">*</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="ilce" value="<?php echo $_SESSION["ilce"]?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<button name="kullaniciupdate" class="btn btn-default btn-red">Güncelle</button>
				</div>
			</div>
		</form>
		<div class="spacer"></div>
	</div>
	<?php include 'footer.php';?>