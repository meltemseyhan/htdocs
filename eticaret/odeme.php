<?php 
include 'header.php';

$userid = $_SESSION["id"]; 
$statementSepet= $db->prepare("SELECT s.id as id, s.urunid as urunid, u.ad as urunad, s.adet as adet, s.fiyat as fiyat
FROM sepet s, urun u WHERE u.id=s.urunid and userid='$userid' and s.durum='1' and u.durum='1'");
$statementSepet->execute();

$statementBankahesap= $db->prepare("SELECT * FROM bankahesap WHERE durum='1'");
$statementBankahesap->execute();
?>
	<head>
    	<title><?php echo $row['title']?> - Ödeme</title>
	</head>
	<div class="container">
		<div class="title-bg">
			<div class="title">Ödeme Sayfası</div>
		</div>
		<form action="nedmin/netling/islem.php" method="POST">
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
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
						<td><img src="images\demo-img.jpg" width="100" alt=""></td>
						<td><?php echo $rowSepet["urunad"]?></td>
						<td><input type="text" name="urunid[]" readonly value="<?php echo $rowSepet["urunid"]?>"></td>
						<td><input type="text" name="adet[]" readonly value="<?php echo $rowSepet["adet"]?>"></td>
						<td><input type="text" name="fiyat[]" readonly value="<?php echo $rowSepet["fiyat"]?>"><?php echo $row['parabirimi']?></td>
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
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			</div>
		</div>

		<div class="tab-review">
			<ul id="myTab" class="nav nav-tabs shop-tab">
				<li class=""><a href="#kredikart" data-toggle="tab">Kredi Kartı</a></li>
				<li class="active"><a href="#havale" data-toggle="tab">Banka Havalesi</a></li>
			</ul>
			<div id="myTabContent" class="tab-content shop-tab-ct">
				<div class="tab-pane fade" id="kredikart">

				</div>
				<div class="tab-pane fade active in" id="havale">
						<p>Ödeme yapacağınız hesap numarasını seçerek işlemi tamamlayınız.</p>
						<?php while ($rowBankahesap=$statementBankahesap->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="row">
							<div class="col-md-1">
								<input type="radio" name="bankahesapid" value="<?php echo $rowBankahesap["id"]?>">
							</div>
							<div class="col-md-3">
								<?php echo $rowBankahesap["ad"]?>
							</div>
							<div class="col-md-3">
								<?php echo $rowBankahesap["iban"]?>
							</div>
							<div class="col-md-5">
								<?php echo $rowBankahesap["adsoyad"]?>
							</div>
						</div>
						<?php } ?>
						<div class="row">
							<hr>
							<div class="col-md-5 col-md-offset-7">
								<button type="submit" name="createsiparis" class="btn-success">Sipariş Ver</button>
							</div>
						</div>
						<input type="hidden" name="toplam" value="<?php echo $subtotal?>">
						<input type="hidden" name="no" value="0">
						<input type="hidden" name="tip" value="havale">
					</form>
				</div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>
<?php 
include 'footer.php';
?>