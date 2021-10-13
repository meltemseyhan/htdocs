<?php
include 'header.php';

$statementYorum= $db->prepare("SELECT y.id as id, y.tarih as tarih, y.icerik as icerik, u.adsoyad as adsoyad, 
ur.id as urunid, ur.ad as urunad, y.durum as durum FROM yorum y, user u, urun ur WHERE y.urunid=ur.id and y.userid=u.id");
$statementYorum->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yorum Listesi</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tarih</th>
                          <th>İçerik</th>
                          <th>Ad Soyad</th>
                          <th>ürün No</th>
                          <th>ÜrünAd</th>
                          <th>Onay Durumu</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowYorum=$statementYorum->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowYorum['id']?></td>
                          <td><?php echo $rowYorum['tarih']?></td>
                          <td><?php echo $rowYorum['icerik']?></td>
                          <td><?php echo $rowYorum['adsoyad']?></td>
                          <td><?php echo $rowYorum['urunid']?></td>
                          <td><?php echo $rowYorum['urunad']?></td>
                          <?php if($rowYorum["durum"]=='0') {?>
                            <td><center><a href="../netling/islem.php?yorumonay=<?php echo $rowYorum['id']?>"><button name="onayla" class="btn btn-primary btn-xs">Onay Ver</button></a></center></td>
                          <?php } else {?>
                            <td><center><a href="../netling/islem.php?yorumred=<?php echo $rowYorum['id']?>"><button name="reddet" class="btn btn-primary btn-xs">Onayı Kaldır</button></a></center></td>
                          <?php }?>  
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>