<?php
include 'header.php';

$statementMenu = $db->prepare("SELECT * FROM menu WHERE seourl='".$_GET['seourl']."'");
$statementMenu->execute();
//Tek satır bekliyoruz
$rowMenu=$statementMenu->fetch(PDO::FETCH_ASSOC);
?>

	<head>
    	<title><?php echo $row['title']?> - <?php echo $rowMenu["ad"];?></title>
	</head>

	<div class="container">
		<div class="row">
			<div class="title-bg">
				<div class="title"><?php echo $rowMenu["ad"];?></div>
			</div>
			<div class="col-md-9"><!--Main content-->
				<div class="page-content">
					<p>
						<?php echo $rowMenu["detay"];?>
					</p>
				</div>

			</div>
		</div>

		<?php 
		include 'sidebar.php';
		?>


		<div class="spacer"></div>
	</div>
<?php 
include 'footer.php';
?>