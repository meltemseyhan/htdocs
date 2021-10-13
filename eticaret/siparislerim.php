<?php 
include 'header.php';
$statementSiparis= $db->prepare("SELECT * FROM siparis WHERE siparis.userid =". $_SESSION['id']);
$statementSiparis->execute();
?>
	<head>
    	<title><?php echo $row['title']?> - Siparişlerim</title>
	</head>
	<div class="container">
		<div id="title-bg">
			<div class="title">Siparişlerim</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Sipariş No</th>
						<th>Tarih</th>
						<th>Toplam Tutar</th>
						<th>Ödeme Tipi</th>
						<th>Ödeme Durumu</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($rowSiparis=$statementSiparis->fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
						<td><?php echo $rowSiparis["id"]?></td>
						<td><?php echo $rowSiparis["zaman"]?></td>
						<td><?php echo $rowSiparis["toplam"]?> <?php echo $row["parabirimi"]?></td>
						<td><?php echo $rowSiparis["tip"]?></td>
						<td><?php echo $rowSiparis["odeme"]=='0'?'Ödenmedi':'Ödendi' ?></td>
						<td><a href="siparis-detay?siparisid=<?php echo $rowSiparis["id"]?>"><i class="fa fa-eye"></i>Detay</a></td>
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