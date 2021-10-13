<?php 
include 'header.php';


//Her sayfada 4 ürün göster
$page = isset($_GET["page"])?$_GET["page"]:1;
$countPerPage = 4;
$startindex = ($page - 1) * $countPerPage;

$kategoriseourl = $_GET["seourl"];
$statementKategori= $db->prepare("SELECT * FROM kategori WHERE seourl='$kategoriseourl' ");
$statementKategori->execute();
//Tek satır gelmeli
$rowKategori=$statementKategori->fetch(PDO::FETCH_ASSOC);
$kategoriid= $rowKategori['id'];

//Toplam ürün sayısını çek
$statementSay= $db->prepare("SELECT count(*) as say FROM urun u WHERE u.kategoriid=$kategoriid and u.durum='1'");
$statementSay->execute();
$rowSay=$statementSay->fetch(PDO::FETCH_ASSOC);
$pageCount = ceil($rowSay["say"] / $countPerPage);

//Ürün listesini çek
$statementUrun= $db->prepare("SELECT * FROM urun u WHERE u.kategoriid=$kategoriid and u.durum='1' order by u.id desc LIMIT $startindex, $countPerPage");
$statementUrun->execute();
?>
	<head>
    	<title><?php echo $row['title']?> - <?php echo $rowKategori['ad']?></title>
	</head>
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $rowKategori['ad']?> - Tüm Ürünler</div>
					<div class="title-nav">
						<a href="kategori-grid-<?php echo $kategoriseourl?>.php"><i class="fa fa-th-large"></i>Grid</a>
						<a href="kategori-list-<?php echo $kategoriseourl?>.php"><i class="fa fa-bars"></i>List</a>
						<div class="clearfix"></div>
					</div>
				</div>

				
				<ul class="gridlist">
					<?php while ($rowUrun=$statementUrun->fetch(PDO::FETCH_ASSOC)) { ?>
					<li class="gridlist-inner">
						<div class="white">
						<div class="row clearfix">
							<div class="col-md-4">
								<div class="pr-img">
									<div class="hot"></div>
									<a href="urun-detay-<?php echo $rowUrun['seourl']?>.php"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="gridlisttitle"><?php echo $rowUrun['ad']?> <span>Ürün no.: <?php echo $rowUrun['id']?></span></div>
								<p class="gridlist-desc">
								<?php echo substr($rowUrun['detay'], 0, 200)?><a href="urun-detay-<?php echo $rowUrun['seourl']?>.php"> devamı için tıklayın...</a>
								</p>
							</div>
							<div class="col-md-2">
								<div class="gridlist-pricetag on-sale"><div class="inner"><span><?php echo $rowUrun['fiyat']?> <?php echo $row['parabirimi']?></span></div></div>
							</div>
						</div>
						</div>
						<div class="gridlist-act">
							<a href="urun-detay-<?php echo $rowUrun['seourl']?>.php"><span class="trolly">&nbsp;</span>Sepete Ekle</a>
							<a href="#"><i class="fa fa-plus"></i>Karşılaştırma Listesine Ekle</a>
							<div class="clearfix"></div>
						</div>
					</li>
                    <?php }?>  
				</ul>
				
				<ul class="pagination shop-pag"><!--pagination-->				
				<?php
					if($pageCount>1){
						$prev = $page - 1;
						if ($prev == 0) {
							$prev = 1;
						}
						$next = $page + 1;
						if ($next > $pageCount) {
							$next = $pageCount;
						}
						echo "<li><a href='kategori-grid-".$kategoriseourl.".php?page=1'><i class='fa fa-backward'></i></a></li>";
						echo "<li><a href='kategori-grid-".$kategoriseourl.".php?page=$prev'><i class='fa fa-caret-left'></i></a></li>";
						for ($i=1; $i <= $pageCount; $i++) { 
							echo "<li><a href='kategori-grid-".$kategoriseourl.".php?page=$i'>".$i."</a></li>";
						}
						echo "<li><a href='kategori-grid-".$kategoriseourl.".php?page=$next'><i class='fa fa-caret-right'></i></a></li>";
						echo "<li><a href='kategori-grid-".$kategoriseourl.".php?page=$pageCount'><i class='fa fa-forward'></i></a></li>";
					}
					?>
				</ul><!--pagination-->

			</div>
			<?php 
			include 'sidebar.php';
			?>
		</div>
		<div class="spacer"></div>
	</div>
	
<?php
include 'footer.php';

?>