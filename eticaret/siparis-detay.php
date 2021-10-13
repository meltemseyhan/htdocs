<?php 
include 'header.php';

$statementSiparis= $db->prepare("SELECT * FROM siparis s WHERE s.id =". $_GET['siparisid']);
$statementSiparis->execute();
$rowSiparis=$statementSiparis->fetch(PDO::FETCH_ASSOC);

$statementDetay= $db->prepare("SELECT u.id as urunid, d.fiyat as fiyat, d.adet as adet, u.ad as ad FROM siparisdetay d, urun u WHERE d.urunid = u.id and d.siparisid =". $_GET['siparisid']);
$statementDetay->execute();
?>
	<head>
    	<title><?php echo $row['title']?> - Sipariş Detay</title>
	</head>
	<div class="container">
		<div id="title-bg">
			<div class="title">Sipariş Detayları</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered chart">
				<tbody>
					<tr>
						<th>Sipariş No</th>
						<td><?php echo $rowSiparis["id"]?></td>
					</tr>
					<tr>
						<th>Tarih</th>
						<td><?php echo $rowSiparis["zaman"]?></td>
					</tr>
					<tr>
						<th>Sipariş Tutarı</th>
						<td><?php echo $rowSiparis["toplam"]?> <?php echo $row["parabirimi"]?></td>
					</tr>
					<tr>
						<th>Ödeme Durumu</th>
						<td><?php echo $rowSiparis["odeme"]=='0'?'Ödenmedi':'Ödendi' ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="spacer"></div>

		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Ürün No</th>
						<th>Ürün Adı</th>
						<th>Ürün Fiyatı</th>
						<th>Adet</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($rowDetay=$statementDetay->fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
						<td><?php echo $rowDetay["urunid"]?></td>
						<td><?php echo $rowDetay["ad"]?></td>
						<td><?php echo $rowDetay["fiyat"]?> <?php echo $row["parabirimi"]?></td>
						<td><?php echo $rowDetay["adet"]?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="spacer"></div>
	</div>

<?php 
include 'footer.php';
?>