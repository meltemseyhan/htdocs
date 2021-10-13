<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Meltem PHP Eğitim E-ticaret</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  </head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-title-wrap">
                <div class="page-title-inner">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bigtitle">Admin Portal Giriş Sayfası</div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="row">
        <form action="../netling/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Kullanıcı Adı (Mail) <span class="required">*</span>
            </label>
            <?php 
                session_start();
                if (isset($_COOKIE["mail"]) and $_COOKIE["mail"] <> "") {
                    $mailtext = "value='". $_COOKIE["mail"]."'";
                    $checked = true;
                } else {
                    $mailtext = "placeholder='Kullanıcı adınızı giriniz...'";
                    $checked = false;
                }

                if (isset($_COOKIE["password"]) and $_COOKIE["password"] <> "") {
                    $passtext = "value='". $_COOKIE["password"]."'";
                } else {
                    $passtext = "placeholder='Şifrenizi giriniz...'";
                }
            ?>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="mail" required="required" class="form-control col-md-7 col-xs-12" <?php echo $mailtext?>>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Şifre<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="password" required="required" class="form-control col-md-7 col-xs-12" <?php echo $passtext?>>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="captcha">Güvenlik Kodu<span class="required">*</span>
            </label>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <input type="text" name="captcha" required="required" class="form-control col-md-7 col-xs-12" placeholder="Güvenlik kodunu giriniz...">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <img id="captchaimg" src="../../securimage/securimage_show.php" alt="Captcha göster"/>
                <a href="#" onclick="document.getElementById('captchaimg').src='../../securimage/securimage_show.php?'+ Math.random(); return false;">[Resim Değiştir]</a>
            </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
            <div style="text-align: right;" class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                <input type="checkbox" <?php echo $checked?'checked':''?> class="form-check-input" name="hatirla">
                <label class="form-check-label">Beni Hatırla</label>
            </div>
            <div style="text-align: left;" class="col-md-3 col-sm-3 col-xs-6">
                <button type="submit" name="adminlogin" class="btn btn-success">Giriş Yap</button>
            </div>
            </div>


        </form>
    </div>

	</div>

</div>


</body>

</html>