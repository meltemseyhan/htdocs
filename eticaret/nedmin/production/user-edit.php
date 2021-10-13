<?php 
include 'header.php';
$durum = 'İşlem durumu';
if (isset($_GET["durum"]) AND $_GET["durum"]=="ok") {
  $durum =  "DB işlemi başarılı";
} elseif (isset($_GET["durum"]) AND $_GET["durum"]=="hata") {
  $durum = "DB işlemi hatalı";
}

$statementUser = $db->prepare("SELECT * FROM user WHERE id=:id");
$statementUser->execute(
  array(
    "id"=>$_GET['id']
  )
);
$rowUser=$statementUser->fetch(PDO::FETCH_ASSOC);
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kullanıcı Bilgileri<small><?php echo $durum?></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="../netling/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="id" readonly class="form-control col-md-7 col-xs-12" value="<?php echo $rowUser['id']?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tc">TC Kimlik No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="tc" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUser['tc']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adsoyad">Ad Soyad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="adsoyad" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUser['adsoyad']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mail">E-posta Adresi <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" name="mail" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUser['mail']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gsm">Cep Telefonu <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="gsm" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUser['gsm']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zaman">Yaratılma Zamanı<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
                          $php_timestamp = strtotime($rowUser['zaman']);
                          $html_datetime_string = date('Y-m-d\TH:i', $php_timestamp);
                          ?>
                          <input type="datetime-local" readonly name="zaman" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $html_datetime_string?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="durum">Durum <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="durum" required="required" class="form-control" value="<?php echo $rowUser['durum']?>">
                            <option value='0' <?php echo $rowUser['durum']=='0'?'selected':''?>>Pasif</option>
                            <option value='1' <?php echo $rowUser['durum']=='1'?'selected':''?>>Aktif</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div style="text-align: right;" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="updateuser" class="btn btn-success">Güncelle</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php
include 'footer.php';
?>
