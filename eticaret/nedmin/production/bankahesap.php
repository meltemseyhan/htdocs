<?php
include 'header.php';

$statementBankahesap= $db->prepare("SELECT * FROM bankahesap");
$statementBankahesap->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Banka Hesap Listesi</h2>

                    <div class="clearfix"></div>
                    <div align="right">
                      <a href="bankahesap-add.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Hesap Adı</th>
                          <th>IBAN</th>
                          <th>Hesap Sahibinin Adı Soyadı</th>
                          <th>Durum</th>
                          <th>Düzenle</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowBankahesap=$statementBankahesap->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowBankahesap['id']?></td>
                          <td><?php echo $rowBankahesap['ad']?></td>
                          <td><?php echo $rowBankahesap['iban']?></td>
                          <td><?php echo $rowBankahesap['adsoyad']?></td>
                          <td><center><button class="btn <?php echo $rowBankahesap['durum']=='1'?'btn-success':'btn-danger'?> btn-xs"><?php echo $rowBankahesap['durum']=='1'?'Aktif':'Pasif'?></center></td>
                          <td><center><a href="bankahesap-edit.php?id=<?php echo $rowBankahesap['id']?>"><button name="editbankahesap" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                          <td><center><a href="../netling/islem.php?deletebankahesap=<?php echo $rowBankahesap['id']?>"><button name="deletebankahesap" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>