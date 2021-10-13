<?php
include 'header.php';

$statementSlider= $db->prepare("SELECT * FROM slider");
$statementSlider->execute();

?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Slider Listesi</h2>

                    <div class="clearfix"></div>
                    <div align="right">
                      <a href="slider-add.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
                    </div>
                  </div>
                  <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Ad</th>
                          <th>Resim Yol</th>
                          <th>Sıra</th>
                          <th>Link</th>
                          <th>Durum</th>

                          <th>Düzenle</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while ($rowSlider=$statementSlider->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $rowSlider['id']?></td>
                          <td><?php echo $rowSlider['ad']?></td>
                          <td><img width=200 src="../../<?php echo $rowSlider['resimyol']?>"></td>
                          <td><?php echo $rowSlider['sira']?></td>
                          <td><?php echo $rowSlider['link']?></td>
                          <td><center><button class="btn <?php echo $rowSlider['durum']=='1'?'btn-success':'btn-danger'?> btn-xs"><?php echo $rowSlider['durum']=='1'?'Aktif':'Pasif'?></center></td>
                          
                          ,<td><center><a href="slider-edit.php?id=<?php echo $rowSlider['id']?>"><button name="editslider" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                          <td><center><a href="../netling/islem.php?deleteslider=<?php echo $rowSlider['id']?>"><button name="deleteslider" class="btn btn-danger btn-xs">Sil</button></a></center></td>
                        </tr>
                      <?php }?>  
                      </tbody>
                    </table>

                  </div>
                </div>

<?php
include 'footer.php';
?>