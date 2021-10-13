<?php 
include 'header.php';
$durum = 'İşlem durumu';
if (isset($_GET["durum"]) AND $_GET["durum"]=="ok") {
  $durum =  "DB işlemi başarılı";
} elseif (isset($_GET["durum"]) AND $_GET["durum"]=="hata") {
  $durum = "DB işlemi hatalı";
}

$statementSlider = $db->prepare("SELECT * FROM slider WHERE id=:id");
$statementSlider->execute(
  array(
    "id"=>$_GET['id']
  )
);
$rowSlider=$statementSlider->fetch(PDO::FETCH_ASSOC);
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Slider Bilgileri<small><?php echo $durum?></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="../netling/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="id" readonly class="form-control col-md-7 col-xs-12" value="<?php echo $rowSlider['id']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ad">Ad<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="ad" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowSlider['ad']?>">
                        </div>
                      </div>
                      <input type="hidden" name="eski_resimyol" value="<?php echo $rowSlider['resimyol']?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resimyol">Resim Yol 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="resimyol" class="form-control col-md-7 col-xs-12" value="<?php echo $rowSlider['resimyol']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link">Link<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="link" class="form-control col-md-7 col-xs-12" value="<?php echo $rowSlider['link']?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sira">Sıra<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="sira" max='9' required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowSlider['sira']?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="durum">Durum <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="durum" required="required" class="form-control" value="<?php echo $rowSlider['durum']?>">
                            <option value='0' <?php echo $rowSlider['durum']=='0'?'selected':''?>>Pasif</option>
                            <option value='1' <?php echo $rowSlider['durum']=='1'?'selected':''?>>Aktif</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div style="text-align: right;" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="updateslider" class="btn btn-success">Güncelle</button>
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
