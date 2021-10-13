<?php 
include 'header.php';
$durum = 'İşlem durumu';
if (isset($_GET["durum"]) AND $_GET["durum"]=="ok") {
  $durum =  "DB işlemi başarılı";
} elseif (isset($_GET["durum"]) AND $_GET["durum"]=="hata") {
  $durum = "DB işlemi hatalı";
}

$statementUrun = $db->prepare("SELECT * FROM urun WHERE id=:id");
$statementUrun->execute(
  array(
    "id"=>$_GET['id']
  )
);
$rowUrun=$statementUrun->fetch(PDO::FETCH_ASSOC);

$statementKategori= $db->prepare("SELECT * FROM kategori order by sira asc");
$statementKategori->execute();
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ürün Bilgileri<small><?php echo $durum?></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="../netling/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="id" readonly class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['id']?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategoriid">Kategori <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="kategoriid" required="required" class="form-control">
                            <?php while ($rowKategori=$statementKategori->fetch(PDO::FETCH_ASSOC)) { ?>
                              <option value='<?php echo $rowKategori['id']?>' <?php echo $rowUrun['kategoriid']==$rowKategori['id']?'selected':''?>><?php echo $rowKategori['ad']?></option>
                            <?php }?>  
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ad">Ad<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="ad" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['ad']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detay">Detay <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="detay" id="detay" required="required" class="ckeditor"><?php echo $rowUrun['detay']?></textarea>
                          <script>
                            CKEDITOR.replace( 'detay' );
                          </script>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fiyat">Fiyat<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="fiyat" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['fiyat']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="video">Video
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="video" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['video']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Anahtar Kelimeler<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="keyword" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['keyword']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stok">Stok<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="stok" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['stok']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="seourl">SEO URL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled name="seourl" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rowUrun['seourl']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="onecikar">Öne Çıkar <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="onecikar" required="required" class="form-control" value="<?php echo $rowUrun['onecikar']?>">
                            <option value='0' <?php echo $rowUrun['onecikar']=='0'?'selected':''?>>Hayır</option>
                            <option value='1' <?php echo $rowUrun['onecikar']=='1'?'selected':''?>>Evet</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="durum">Durum <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="durum" required="required" class="form-control" value="<?php echo $rowUrun['durum']?>">
                            <option value='0' <?php echo $rowUrun['durum']=='0'?'selected':''?>>Pasif</option>
                            <option value='1' <?php echo $rowUrun['durum']=='1'?'selected':''?>>Aktif</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div style="text-align: right;" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="updateurun" class="btn btn-success">Güncelle</button>
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
