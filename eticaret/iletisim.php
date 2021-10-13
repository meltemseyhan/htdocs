<?php 
include 'header.php';
?>

	<head>
    	<title><?php echo $row['title']?> - İletişim</title>
	</head>
	
	<div class="container">
		<div class="title-bg">
			<div class="title">İletişim</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<p class="page-content">
					Telefon, e-posta ya da aşağıdaki form aracılığı ile bizimle iletişime geçebilirsiniz.
				</p>
				<ul class="contact-widget">
					<li class="fphone"><?php echo $row["tel"]?></li>
					<li class="fmobile"><?php echo $row["gsm"]?></li>
					<li class="fmail lastone"><?php echo $row["mail"]?></li>
				</ul>
			</div>
			<div class="col-md-7 col-md-offset-1">
				<div class="loc">
					<div id="map_canvas"></div>
				</div>
			</div>
		</div>
		
		<div class="title-bg">
			<div class="title">Hızlı İletişim Formu</div>
		</div>
		<div class="qc">
			<form role="form" action="mail.php" method="POST">
				<div class="form-group">
					<label for="adsoyad">Adınız Soyadınız<span>*</span></label>
					<input type="text" class="form-control" name="adsoyad" id="adsoyad">
				</div>
				<div class="form-group">
					<label for="mail">E-posta Adresiniz<span>*</span></label>
					<input type="email" class="form-control" name="mail" id="mail">
				</div>
				<div class="form-group">
					<label for="text">Mesajınız<span>*</span></label>
					<textarea class="form-control" name="text" id="text"></textarea>
				</div>
				<?php 
				$sayi1 = rand(10,30);
				$sayi2 = rand(0,10);
				$toplam = $sayi1 + $sayi2;
				?>
				<input type="hidden" name="toplam" value="<?php echo $toplam?>">
				<div class="form-group">
					<label for="islem">İşlem Sonucu<span>*</span></label>
					<input type="text" class="form-control" name="islem" id="islem" placeholder="<?php echo $sayi1.' + '.$sayi2.' kaçtır ?'?>">
				</div>	

				<button type="submit" name="mailgonder" class="btn btn-default btn-red btn-sm">Gönder</button>
			</form>
		</div>
		<div class="spacer"></div>
		
	</div>
	
<?php 
include 'footer.php';
?>	