<?php
include 'header.php';
//Öne çıkan ürünlerden rastgele 10 tanesini çek
$statementUrun= $db->prepare("SELECT * FROM urun u WHERE u.durum='1' and u.onecikar='1' order by rand() limit 10");
$statementUrun->execute();

$statementAbout = $db->prepare("SELECT * FROM about WHERE id='1'");
$statementAbout->execute();
//Tek satır bekliyoruz
$rowAbout=$statementAbout->fetch(PDO::FETCH_ASSOC);
?>
  	<head>
    	<title><?php echo $row['title']?></title>
	</head>

	<div class="container">

		<div class="clearfix"></div>
		<div class="lines"></div>

		<?php include 'slider.php'?>

	</div>
	<div class="f-widget featpro">
		<div class="container">
			<div class="title-widget-bg">
				<div class="title-widget">Öne Çıkan Ürünler</div>
				<div class="carousel-nav">
					<a class="prev"></a>
					<a class="next"></a>
				</div>
			</div>
			<div id="product-carousel" class="owl-carousel owl-theme">
				<?php while ($rowUrun=$statementUrun->fetch(PDO::FETCH_ASSOC)) {
					$statementFoto= $db->prepare("SELECT * FROM urunfoto f WHERE f.urunid={$rowUrun['id']} and f.durum='1' order by f.sira limit 1");
					$statementFoto->execute();
					$rowFoto=$statementFoto->fetch(PDO::FETCH_ASSOC);
					if ($rowFoto) {
						$resimyol = $rowFoto["resimyol"];
					} else {
						$resimyol = 'dimg/nofoto.jpeg';
					}
				?>	
					<div class="item">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="urun-detay-<?php echo $rowUrun['seourl']?>.php"><img src="<?php echo $resimyol?>" alt="" class="img-responsive"></a>
								<div class="pricetag blue"><div class="inner"><span><?php echo $rowUrun['fiyat']?> <?php echo $row['parabirimi']?></span></div></div>
							</div>
								<span class="smalltitle"><a href="urun-detay-<?php echo $rowUrun['seourl']?>.php"><?php echo $rowUrun['ad']?></a></span>
								<span class="smalldesc">Ürün no: <?php echo $rowUrun['id']?></span>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
	
	
	
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Hakkımızda</div>
				</div>
				<p class="ct">
					<?php echo substr($rowAbout["icerik"], 0, 1000); ?>
				</p>
				<a href="about.php" class="btn btn-default btn-red btn-sm">Devamını Oku...</a>
				
				<div class="title-bg">
					<div class="title">Lastest Products</div>
				</div>
				<div class="row prdct"><!--Products-->
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<a href="product.htm"><img src="images\sample-2.jpg" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice">$314</span>$199</span></div></div>
							</div>
							<span class="smalltitle"><a href="product.htm">Black Shoes</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Nikon Camera</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Red T- Shirt</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Nikon Camera</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-2.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Black Shoes</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Red T-Shirt</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->
			<?php 
			include 'sidebar.php';
			?>
		</div>
	</div>
<?php
include 'footer.php';
?>