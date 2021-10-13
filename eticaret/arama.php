<?php 
include 'header.php';

$pageCount=0;

if(isset($_GET["arama"])){
	$_POST["arama"] = $_GET["arama"];
}

if(isset($_POST["arama"])){
	$arama= '%'.$_POST["arama"].'%';

	$statement = $db->prepare("select * from urun where ad like :arama and durum='1'");
	$result = $statement->execute(
		array(
			"arama"=>$arama
		)
	);
	if(!$result) {
		Header("Location:index.php");
		exit;
	} 

	//Her sayfada 4 ürün göster
	$page = isset($_GET["page"])?$_GET["page"]:1;
	$countPerPage = 4;
	$startindex = ($page - 1) * $countPerPage;

	//Toplam ürün sayısını çek
	$rowCount =  $statement->rowCount();
	$pageCount = ceil($rowCount / $countPerPage);

	//Ürün listesini çek
	$statement= $db->prepare("select * from urun where ad like :arama and durum='1' order by id desc LIMIT $startindex, $countPerPage");
	$result = $statement->execute(
		array(
			"arama"=>$arama
		)
	);
	$statement->execute();

}

?>

	<head>
    	<title><?php echo $row['title']?> - Arama</title>
	</head>
	
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Arama Sonucu</div>
				</div>
				<div class="clearfix"></div>
				
				<ul class="gridlist">
					<?php while ($rowUrun=$statement->fetch(PDO::FETCH_ASSOC)) { ?>
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
							<div class="clearfix"></div>
						</div>
					</li>
                    <?php }?>  
				</ul>
				
				<ul class="pagination shop-pag"><!--pagination-->				
				<?php
					if($pageCount>1){
						$arama=$_POST["arama"];
						$prev = $page - 1;
						if ($prev == 0) {
							$prev = 1;
						}
						$next = $page + 1;
						if ($next > $pageCount) {
							$next = $pageCount;
						}
						echo "<li><a href='arama.php?arama=$arama&page=1'><i class='fa fa-backward'></i></a></li>";
						echo "<li><a href='arama.php?arama=$arama&page=$prev'><i class='fa fa-caret-left'></i></a></li>";
						for ($i=1; $i <= $pageCount; $i++) { 
							echo "<li><a href='arama.php?arama=$arama&page=$i'>".$i."</a></li>";
						}
						echo "<li><a href='arama.php?arama=$arama&page=$next'><i class='fa fa-caret-right'></i></a></li>";
						echo "<li><a href='arama.php?arama=$arama&page=$pageCount'><i class='fa fa-forward'></i></a></li>";
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