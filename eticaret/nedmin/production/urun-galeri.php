<?php
include 'header.php';

$statementUrunfoto= $db->prepare("SELECT * FROM urunfoto WHERE urunid={$_GET["id"]}");
$statementUrunfoto->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ürün Fotoğrafları</h2>

                    <div class="clearfix"></div>
                    <div align="right">
                      <a href="urunfoto-add.php?urunid=<?php echo $_GET['id']?>"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fotoğraf</th>
                          <th>Sıra</th>
                          <th>Durum</th>

                          <th>Düzenle</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowUrunfoto=$statementUrunfoto->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowUrunfoto['id']?></td>
                          <td><img width=200 src="../../<?php echo $rowUrunfoto['resimyol']?>"></td>
                          <td><?php echo $rowUrunfoto['sira']?></td>
                          <td><center><button class="btn <?php echo $rowUrunfoto['durum']=='1'?'btn-success':'btn-danger'?> btn-xs"><?php echo $rowUrunfoto['durum']=='1'?'Aktif':'Pasif'?></center></td>
                          <td><center><a href="../netling/islem.php?deleteurunfoto=<?php echo $rowUrunfoto['id']?>&urunid=<?php echo $_GET['id']?>"><button name="deleteurunfoto" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>