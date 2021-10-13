<?php
include 'header.php';

$statementUser= $db->prepare("SELECT * FROM user");
$statementUser->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kullanıcı Listesi</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Yaratılma Zamanı</th>
                          <th>TC Kimlik No</th>
                          <th>Kullanıcı Adı</th>
                          <th>Email Adresi</th>
                          <th>GSM Numarası</th>
                          <th>Ad Soyad</th>
                          <th>Ünvan</th>
                          <th>Yetki</th>
                          <th>Durum</th>
                          <th>Düzenle</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowUser=$statementUser->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowUser['id']?></td>
                          <td><?php echo $rowUser['zaman']?></td>
                          <td><?php echo $rowUser['tc']?></td>
                          <td><?php echo $rowUser['ad']?></td>
                          <td><?php echo $rowUser['mail']?></td>
                          <td><?php echo $rowUser['gsm']?></td>
                          <td><?php echo $rowUser['adsoyad']?></td>
                          <td><?php echo $rowUser['unvan']?></td>
                          <td><?php echo $rowUser['yetki']?></td>
                          <td><?php echo $rowUser['durum']?></td>
                          <td><center><a href="user-edit.php?id=<?php echo $rowUser['id']?>"><button name="edituser" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                          <td><center><a href="../netling/islem.php?deleteuser=<?php echo $rowUser['id']?>"><button name="deleteuser" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>