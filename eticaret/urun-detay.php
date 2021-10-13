<?php 
include 'header.php';

$urunseourl = $_GET["seourl"];
$statementUrun= $db->prepare("SELECT * FROM urun WHERE seourl='$urunseourl' ");
$statementUrun->execute();
//Tek satır gelmeli
$rowUrun=$statementUrun->fetch(PDO::FETCH_ASSOC);
$urunid = $rowUrun['id'];
$kategoriid = $rowUrun['kategoriid'];


$statementYorum= $db->prepare("SELECT y.tarih, y.icerik, u.adsoyad FROM yorum y, user u WHERE y.urunid=$urunid and y.userid=u.id and y.durum='1'");
$statementYorum->execute();
$yorumCount =  $statementYorum->rowCount();

$statementBenzerUrun= $db->prepare("SELECT * FROM urun WHERE kategoriid='$kategoriid' and durum='1' order by rand() limit 3");
$statementBenzerUrun->execute();

$statementUrunfoto= $db->prepare("SELECT * FROM urunfoto WHERE urunid='$urunid' and durum='1' order by sira");
$statementUrunfoto->execute();
?>
	
		<head>
			<title><?php echo $row['title']?> - <?php echo $rowUrun['ad']?></title>
		</head>

		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $rowUrun['ad']?></div>
				</div>
				<div class="row">
					<div class="col-md-6">

						<?php 
						//İlk resmi al
						$rowUrunfoto=$statementUrunfoto->fetch(PDO::FETCH_ASSOC);
						if ($rowUrunfoto) {
							$resimyol = $rowUrunfoto['resimyol'];
						} else {
							$resimyol = 'dimg/nofoto.jpeg';
						}?>
						<div class="dt-img">
							<div class="detpricetag"><div class="inner"><?php echo $rowUrun['fiyat']?> <?php echo $row['parabirimi']?></div></div>
							<a class="fancybox" href="<?php echo $resimyol?>" data-fancybox-group="gallery" title="<?php echo $rowUrun['ad']?>"><img width=800 height="800" src="<?php echo $resimyol?>" alt="" class="img-responsive"></a>
						</div>

						<?php while ($rowUrunfoto=$statementUrunfoto->fetch(PDO::FETCH_ASSOC)) { ?>
							<div class="thumb-img">
								<a class="fancybox" href="<?php echo $rowUrunfoto['resimyol']?>" data-fancybox-group="gallery" title="<?php echo $rowUrun['ad']?>"><img width=200 height="200" src="<?php echo $rowUrunfoto['resimyol']?>" alt="" class="img-responsive"></a>
							</div>
						<?php }?>
					</div>
					<div class="col-md-6 det-desc">
						<div class="productdata">
							<div class="infospan">Ürün no <span><?php echo $rowUrun['id']?></span></div>
							<hr>					
							<form action="nedmin/netling/islem.php" method="POST" class="form-horizontal ava" role="form">
								<div class="form-group">
									<label for="adet" class="col-sm-2 control-label">Adet</label>
									<div class="col-sm-6">
										<input type="number" name="adet"class="form-control" value="1">
										<input type="hidden" name="urunid" value="<?php echo $rowUrun['id']?>">
										<input type="hidden" name="fiyat" value="<?php echo $rowUrun['fiyat']?>">
									</div>
									<div class="col-sm-4">
										<button type="submit" name="sepeteekle"class="btn btn-default btn-red btn-sm" <?php echo !isset($_SESSION['id'])?'disabled':''?>><span class="addchart">Sepete Ekle</span></button>
									</div>
									<div class="clearfix"></div>
								</div>
							</form>
							<hr>
							<div class="sharing">
								<div class="share-bt">
									<div class="addthis_toolbox addthis_default_style ">
										<a class="addthis_counter addthis_pill_style"></a>
									</div>
									<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
									<div class="clearfix"></div>
								</div>
								<div class="avatock">
									<span>
									<?php 
									if ($rowUrun['stok'] > 0) {
										echo "Stok Adedi :". $rowUrun['stok'];
									} else {
										echo 'Ürün stokta yok';
									}		
									?>
									</span>
								</div>
							</div>
							
						</div>
					</div>
				</div>

				<div class="tab-review">
					<ul id="myTab" class="nav nav-tabs shop-tab">
						<li class="active"><a href="#desc" data-toggle="tab">Ürün Açıklaması</a></li>
						<li class=""><a href="#rev" data-toggle="tab">Yorumlar (<?php echo $yorumCount?>)</a></li>
						<li class=""><a href="#video" data-toggle="tab">Video</a></li>
					</ul>
					<div id="myTabContent" class="tab-content shop-tab-ct">
						<div class="tab-pane fade active in" id="desc">
							<p>
								<?php echo $rowUrun["detay"] ?>
							</p>
						</div>
						<div class="tab-pane fade" id="rev">
							<?php
							while ($rowYorum=$statementYorum->fetch(PDO::FETCH_ASSOC)) { 
								$adsoyad = $rowYorum['adsoyad'];
								$tarih = $rowYorum['tarih'];
								$icerik = $rowYorum['icerik'];
								echo '<p class="dash">';
								echo "<span>$adsoyad</span> $tarih<br><br>";
								echo $icerik;
								echo "</p>";
							}
							?>
							<?php if (isset($_SESSION['id'])) {?>
							<h4>Yorum Yaz</h4>
							<form action="nedmin/netling/islem.php" method="POST" role="form">
								<div class="form-group">
									<textarea class="form-control" name="icerik" id="icerik"></textarea>
								</div>
								<div class="form-group">
									<div class="rate"><span>Puan:</span></div>
									<div class="starwrap">
										<div id="default"></div>
									</div>
									<div class="clearfix"></div>
								</div>
								<input type="hidden" name="urunseourl" value="<?php echo $urunseourl?>"> 
								<input type="hidden" name="urunid" value="<?php echo $urunid?>"> 
								<input type="hidden" name="puan" value="3"> 
								<button type="submit" name="createyorum" class="btn btn-default btn-red btn-sm">Ekle</button>
							</form>
							<?php }?>
						</div>
						<div class="tab-pane fade" id="video">
							<?php if ($rowUrun["video"]) {?>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $rowUrun["video"];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<?php } else { echo "Bu ürüne video eklenmemiştir";}?>
						</div>
					</div>
				</div>
				
				<div id="title-bg">
					<div class="title">Benzer Ürünler</div>
				</div>
				<div class="row prdct"><!--Products-->
					<?php while ($rowBenzerUrun=$statementBenzerUrun->fetch(PDO::FETCH_ASSOC)) {?>

					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="urun-detay-<?php echo $rowBenzerUrun['seourl']?>.php"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><?php echo $rowBenzerUrun['fiyat']?> <?php echo $row['parabirimi']?> </span></div></div>
							</div>
							<span class="smalltitle"><a href="urun-detay-<?php echo $rowBenzerUrun['seourl']?>.php"><?php echo $rowBenzerUrun['ad']?></a></span>
							<span class="smalldesc">Ürün no: <?php echo $rowBenzerUrun['id']?></span>
						</div>
					</div>

					<?php }?>
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