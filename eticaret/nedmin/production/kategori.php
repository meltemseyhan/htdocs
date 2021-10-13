<?php
include 'header.php';

$statementKategori= $db->prepare("SELECT * FROM kategori order by sira asc");
$statementKategori->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kategori Listesi</h2>

                    <div class="clearfix"></div>
                    <div align="right">
                      <a href="kategori-add.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Üst Kategori</th>
                          <th>Ad</th>
                          <th>Sıra</th>
                          <th>SEO URL</th>
                          <th>Durum</th>
                          <th>Düzenle</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowKategori=$statementKategori->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowKategori['id']?></td>
                          <td><?php echo $rowKategori['ust']?></td>
                          <td><?php echo $rowKategori['ad']?></td>
                          <td><?php echo $rowKategori['sira']?></td>
                          <td><?php echo $rowKategori['seourl']?></td>
                          <td><center><button class="btn <?php echo $rowKategori['durum']=='1'?'btn-success':'btn-danger'?> btn-xs"><?php echo $rowKategori['durum']=='1'?'Aktif':'Pasif'?></center></td>
                          <td><center><a href="kategori-edit.php?id=<?php echo $rowKategori['id']?>"><button name="editkategori" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                          <td><center><a href="../netling/islem.php?deletekategori=<?php echo $rowKategori['id']?>"><button name="deletekategori" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>