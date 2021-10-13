<?php 
include 'header.php';
$durum = 'İşlem durumu';
if (isset($_GET["durum"]) AND $_GET["durum"]=="ok") {
  $durum =  "DB işlemi başarılı";
} elseif (isset($_GET["durum"]) AND $_GET["durum"]=="hata") {
  $durum = "DB işlemi hatalı";
}
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Genel Ayarlar <small><?php echo $durum?></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="../netling/islem.php" method="POST" enctype="multipart/form-data" id="logo-form" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Yüklü Logo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
                          if (empty($row["logo"])) { 
                            echo "<img src='../../dimg/nofoto.jpeg'>";
                          } else {
                            echo "<img src='../../".$row["logo"]."'>";
                          }
                          ?>
                        </div>
                      </div>

                      <input type="hidden" name="eski_logo" value="<?php echo $row['logo']?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo Seç <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="logo" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div style="text-align: right;" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="updatelogo" class="btn btn-success">Güncelle</button>
                        </div>
                      </div>

                    </form>

                    <hr>

                    <form action="../netling/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Site Başlığı <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['title']?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Site Açıklaması <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="description" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['description']?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keywords">Anahtar Kelimeler <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="keywords" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['keywords']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author">Yazar<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="author" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['author']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parabirimi">Para Birimi<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="parabirimi" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['parabirimi']?>">
                        </div>
                      </div>              
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div style="text-align: right;" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="update" class="btn btn-success">Güncelle</button>
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
