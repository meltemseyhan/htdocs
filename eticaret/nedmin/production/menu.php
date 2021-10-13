<?php
include 'header.php';

$statementMenu= $db->prepare("SELECT * FROM menu order by sira asc");
$statementMenu->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Menü Listesi</h2>

                    <div class="clearfix"></div>
                    <div align="right">
                      <a href="menu-add.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Üst Menü</th>
                          <th>Ad</th>
                          <th>URL</th>
                          <th>Sıra</th>
                          <th>SEO URL</th>
                          <th>Durum</th>
                          <th>Düzenle</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowMenu=$statementMenu->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowMenu['id']?></td>
                          <td><?php echo $rowMenu['ust']?></td>
                          <td><?php echo $rowMenu['ad']?></td>
                          <td><?php echo $rowMenu['url']?></td>
                          <td><?php echo $rowMenu['sira']?></td>
                          <td><?php echo $rowMenu['seourl']?></td>

                          <td><center><button class="btn <?php echo $rowMenu['durum']=='1'?'btn-success':'btn-danger'?> btn-xs"><?php echo $rowMenu['durum']=='1'?'Aktif':'Pasif'?></center></td>
                          <td><center><a href="menu-edit.php?id=<?php echo $rowMenu['id']?>"><button name="editmenu" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                          <td><center><a href="../netling/islem.php?deletemenu=<?php echo $rowMenu['id']?>"><button name="deletemenu" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>