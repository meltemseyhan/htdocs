<?php
    date_default_timezone_set("Europe/Istanbul");
	ob_start();
	session_start();
	include './nedmin/netling/connect.php';
	$statement = $db->prepare("SELECT * FROM ayar WHERE id='1'");
	$statement->execute();
	//Tek satır bekliyoruz
	$row=$statement->fetch(PDO::FETCH_ASSOC);

	if ($row["bakim"] == 1) {
		//Site bakımda
		exit("şu an bakımdayız");
	}

	if (isset($_SESSION["id"])) {
		$userid = $_SESSION["id"]; 
		$statementSepet= $db->prepare("SELECT s.id as id, s.urunid as urunid, u.ad as urunad, s.adet as adet, s.fiyat as fiyat, u.seourl as urunseourl
		FROM sepet s, urun u WHERE u.id=s.urunid and userid='$userid' and s.durum='1' and u.durum='1'");
		$statementSepet->execute();
		$sepet=$statementSepet->fetchAll(PDO::FETCH_ASSOC);
	}
	?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $row['description']?>">
    <meta name="keywords" content="<?php echo $row['keywords']?>">
    <meta name="author" content="<?php echo $row['author']?>">
    <!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">
	
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">

	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">

	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div id="wrapper">
	<div class="header"><!--Header -->
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-md-4 main-logo">
					<a href="index.php"><img width="80" src="<?php echo $row['logo']?>" alt="site logosu" class="logo img-responsive"></a>
				</div>
				<div class="col-md-8">
					<div class="pushright">
						<div class="top">
							<?php if (!isset($_SESSION['id'])) {?>
								<a href="#" id="reg" class="btn btn-default btn-dark">Giriş Yap<span>-- Ya da --</span>Kayıt Ol</a>
							<?php } else {?>
								<a href="#" id="reg" class="btn btn-default btn-dark">Hoşgeldin <?php echo $_SESSION["adsoyad"]?></a>
							<?php } ?>

							<div class="regwrap">
								<div class="row">
									<div class="col-md-6 regform">
										<div class="title-widget-bg">
											<div class="title-widget">Kullanıcı Giriş</div>
										</div>

										<form action="nedmin/netling/islem.php" method="POST" role="form">
											<div class="form-group">
												<input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı veya E-posta...">
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Şifre...">
											</div>
											<div class="form-group">
												<button name="userlogin" class="btn btn-default btn-red btn-sm">Giriş Yap</button>
											</div>
										</form>
									</div>
									<div class="col-md-6">
										<div class="title-widget-bg">
											<div class="title-widget">Yeni Kullanıcı Kayıt</div>
										</div>
										<p>
											Yeni bir kullanıcı oluşturmak ve fırsatlarımızdan faydalanmak için 'Kayıt Ol' butonuna tıklayın...
										</p>
										<a href='register.php'><button class="btn btn-default btn-yellow">Kayıt Ol</button></a>
									</div>


								</div>
							</div>
							<div class="srch-wrap">
								<a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
							</div>
							<div class="srchwrap">
								<div class="row">
									<div class="col-md-12">
										<form action="arama.php" method="POST" class="form-horizontal" role="form">
											<div class="form-group">
												<label for="search" class="col-sm-2 control-label">Search</label>
												<div class="col-sm-10">
													<input type="text" name="arama" class="form-control" id="arama">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="dashed"></div>
	</div><!--Header -->
	<div class="main-nav"><!--end main-nav -->
		<div class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="row">
					<div class="col-md-10">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav">
								<li><a href="index.php" class="active">Anasayfa</a><div class="curve"></div></li>
								<?php
								$statementMenu= $db->prepare("SELECT * FROM menu WHERE durum='1' order by sira asc limit 5");
								$statementMenu->execute();
								while ($rowMenu=$statementMenu->fetch(PDO::FETCH_ASSOC)) { 
									if (!empty($rowMenu['url'])) {
										$url = $rowMenu['url'];
									} else {
										$url = "sayfa-". $rowMenu['seourl'].".php";
									}

									echo "<li><a href='".$url."'>".$rowMenu['ad']."</a></li>";
								}
								?>				
							</ul>
						</div>
					</div>
					<div class="col-md-2 machart">
						<?php
						$subtotal = 0;
						for ($i=0; isset($sepet) and $i < count($sepet); $i++) { 
							$rowSepet = $sepet[$i];
							$toplam=$rowSepet["fiyat"]*$rowSepet["adet"]; 
							$subtotal += $toplam;
						}
						?>
						<button id="popcart" class="btn btn-default btn-chart btn-sm "><span class="mychart">Sepet</span>|<span class="allprice"><?php echo $subtotal.' '.$row["parabirimi"]?></span></button>

						<?php if(isset($sepet) and count($sepet) > 0) {?>
							<div class="popcart">
								<table class="table table-condensed popcart-inner">
									<tbody>
										<?php for ($i=0; $i < count($sepet); $i++) { $rowSepet = $sepet[$i];?>
										<tr>
											<td>
											<a href="urun-detay-<?php echo $rowSepet["urunseourl"]?>.php"><img src="images\dummy-1.png" alt="" class="img-responsive"></a>
											</td>
											<td><a href="urun-detay-<?php echo $rowSepet["urunseourl"]?>.php"><?php echo $rowSepet["urunad"]?></a><br></td>
											<td><?php echo $rowSepet["adet"]?>X</td>
											<td><?php echo $rowSepet["fiyat"]?> <?php echo $row["parabirimi"]?></td>
											<td><a href="nedmin/netling/islem.php?deletesepet=<?php echo $rowSepet["id"]?>"><i class="fa fa-times-circle fa-2x"></i></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<br>
								<div class="btn-popcart">
									<a href="odeme.php" class="btn btn-default btn-red btn-sm">Satınal</a>
									<a href="sepet.php" class="btn btn-default btn-red btn-sm">Sepet</a>
								</div>
								<div class="popcart-tot">
									<p>
										Total<br>
										<span><?php echo $subtotal.' '.$row["parabirimi"]?></span>
									</p>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php }?>
					</div>
					<?php if (isset($_SESSION['id'])) {?>
						<ul class="small-menu">
						<li><a href="hesabim.php" class="myacc">Hesabım</a></li>
						<li><a href="siparislerim.php" class="myshop">Siparişlerim</a></li>
						<li><a href="logout.php" class="mycheck">Çıkış Yap</a></li>
					</ul>
					<?php }?>
				</div>
			</div>
		</div>
	</div><!--end main-nav -->