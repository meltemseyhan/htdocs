<?php 
include 'header.php';

$userid = $_SESSION["id"]; 
$statementSepet= $db->prepare("SELECT s.id as id, s.urunid as urunid, u.ad as urunad, s.adet as adet, s.fiyat as fiyat
FROM sepet s, urun u WHERE u.id=s.urunid and userid='$userid' and s.durum='1' and u.durum='1'");
$statementSepet->execute();
if($statementSepet->rowCount() > 0){
?>
	<head>
    	<title><?php echo $row['title']?> - Alışveriş Sepetiniz</title>
	</head>
	<div class="container">
		<div class="title-bg">
			<div class="title">Sepetiniz</div>
		</div>
		<form action="nedmin/netling/islem.php" method="POST">
			<div class="table-responsive">
				<table class="table table-bordered chart">
					<thead>
						<tr>
							<th>Kaldır</th>
							<th>Resim</th>
							<th>Ürün Adı</th>
							<th>Ürün No</th>
							<th>Adet</th>
							<th>Birim Fiyatı</th>
							<th>Toplam Fiyat</th>
						</tr>
					</thead>
					<tbody>
						<?php $subtotal = 0; while ($rowSepet=$statementSepet->fetch(PDO::FETCH_ASSOC)) { ?>
						<tr>
							<input type="hidden" name="id[]" value="<?php echo $rowSepet["id"]?>"> 
							<td><center><a href="nedmin/netling/islem.php?deletesepet=<?php echo $rowSepet['id']?>"><input type="button" name="deletesepet" class="btn btn-danger btn-xs" value="Çıkar"></a></center></td>
							<td><img src="images\demo-img.jpg" width="100" alt=""></td>
							<td><?php echo $rowSepet["urunad"]?></td>
							<td><?php echo $rowSepet["urunid"]?></td>
							<td><input type="text" name="adet[]" class="form-control quantity" value="<?php echo $rowSepet["adet"]?>"></td>
							<td><?php echo $rowSepet['fiyat']?> <?php echo $row['parabirimi']?></td>
							<td><?php echo $toplam = $rowSepet['fiyat'] * $rowSepet['adet']?> <?php echo $row['parabirimi']?></td>
						</tr>
						<?php $subtotal += $toplam;} ?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-6">
				</div>
				<div class="col-md-3 col-md-offset-3">
				<div class="subtotal-wrap">
					<div class="total">Toplam : <span class="bigprice"><?php echo $subtotal;?> <?php echo $row['parabirimi']?></span></div>
					<a href="odeme.php" class="btn btn-default btn-red btn-sm">Ödeme Yap</a>
					<button type="submit" name="updatesepet" class="btn btn-default btn-red btn-sm">Güncelle</button>
					<div class="clearfix"></div>
					<a href="index.php" class="btn btn-default btn-yellow">Alışverişe Devam Et</a>
				</div>
				<div class="clearfix"></div>
				</div>
			</div>
		</form>
		<div class="spacer"></div>
	</div>
<?php 
} else {
	echo "	<div class='container'><div class='title-bg'><div class='title'>Sepetiniz Boş</div></div></div>";
}
include 'footer.php';
?>