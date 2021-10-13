<?php
include 'header.php';

$statementUrun= $db->prepare("SELECT u.*, k.ad as kategoriad FROM urun u, kategori k WHERE u.kategoriid=k.id order by id desc");
$statementUrun->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ürün Listesi</h2>

                    <div class="clearfix"></div>
                    <div align="right">
                      <a href="urun-add.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Kategory</th>
                          <th>Ad</th>
                          <th>Fiyat</th>
                          <th>Anahtar Kelimeler</th>
                          <th>Stok</th>
                          <th>Durum</th>
                          <th>Resim İşlemleri</th>
                          <th>Düzenle</th>
                          <th>Öne Çıkarma</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowUrun=$statementUrun->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowUrun['id']?></td>
                          <td><?php echo $rowUrun['kategoriad']?></td>
                          <td><?php echo $rowUrun['ad']?></td>
                          <td><?php echo $rowUrun['fiyat'].' '.$row['parabirimi']?></td>
                          <td><?php echo $rowUrun['keyword']?></td>
                          <td><?php echo $rowUrun['stok']?></td>
                          <td><center><button class="btn <?php echo $rowUrun['durum']=='1'?'btn-success':'btn-danger'?> btn-xs"><?php echo $rowUrun['durum']=='1'?'Aktif':'Pasif'?></center></td>
                          <td><center><a href="urun-galeri.php?id=<?php echo $rowUrun['id']?>"><button name="urunfoto" class="btn btn-primary btn-xs">Resim İşlemleri</button></a></center></td>
                          <td><center><a href="urun-edit.php?id=<?php echo $rowUrun['id']?>"><button name="editurun" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                          <?php if($rowUrun["onecikar"]=='0') {?>
                            <td><center><a href="../netling/islem.php?onecikar=<?php echo $rowUrun['id']?>"><button name="onecikar" class="btn btn-primary btn-xs">Öne Çıkar</button></a></center></td>
                          <?php } else {?>
                            <td><center><a href="../netling/islem.php?gerial=<?php echo $rowUrun['id']?>"><button name="gerial" class="btn btn-primary btn-xs">Geri AL</button></a></center></td>
                          <?php }?>  
                          <td><center><a href="../netling/islem.php?deleteurun=<?php echo $rowUrun['id']?>"><button name="deleteurun" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>