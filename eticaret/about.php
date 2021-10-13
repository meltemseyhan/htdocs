<?php
include 'header.php';

$statementAbout = $db->prepare("SELECT * FROM about WHERE id='1'");
$statementAbout->execute();
//Tek satır bekliyoruz
$rowAbout=$statementAbout->fetch(PDO::FETCH_ASSOC);
?>
  	<head>
    	<title><?php echo $row['title']?> - Hakkımızda</title>
	</head>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap">
					<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Hakkımızda Sayfası</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Tanıtım Videosu</div>
				</div>
					
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $rowAbout["video"];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

				<div class="title-bg">
					<div class="title">Vizyon</div>
				</div>
				<div class="page-content">
					<blockquote>
						<?php echo $rowAbout["vizyon"];?>
					</blockquote>
				</div>
				<div class="title-bg">
					<div class="title">Misyon</div>
				</div>
				<div class="page-content">
					<blockquote>
						<?php echo $rowAbout["misyon"];?>
					</blockquote>
				</div>
				<div class="title-bg">
					<div class="title"><?php echo $rowAbout["baslik"];?></div>
				</div>
				<div class="page-content">
					<p>
						<?php echo $rowAbout["icerik"];?>
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