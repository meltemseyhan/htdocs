<?php 
	include './nedmin/netling/connect.php';
    include './nedmin/netling/function.php';
    $statementKategori= $db->prepare("SELECT * FROM kategori WHERE durum='1' order by sira asc");
    $statementKategori->execute();

    $statementUrun= $db->prepare("SELECT * FROM urun WHERE durum='1'");
    $statementUrun->execute();

    header("Content-type:application/xml;charset='UTF-8'",true);
?>


<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>

        <loc>http://<?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/kategoriler'?></loc>

        <lastmod><?php echo date("Y-m-d");?></lastmod>

        <changefreq>daily</changefreq>

        <priority>1.0</priority>

    </url>


    <?php while ($rowKategori=$statementKategori->fetch(PDO::FETCH_ASSOC)) { ?>
    <url>
    
      <loc>http://<?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/kategori-list-'.$rowKategori['seourl']?></loc>

      <lastmod><?php echo date("Y-m-d");?></lastmod>

      <changefreq>monthly</changefreq>

      <priority>0.8</priority>

   </url>

    <?php }?>

    <?php while ($rowUrun=$statementUrun->fetch(PDO::FETCH_ASSOC)) { ?>
    <url>
    
      <loc>http://<?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/urun-detay-'.$rowUrun['seourl']?></loc>

      <lastmod><?php echo date("Y-m-d");?></lastmod>

      <changefreq>monthly</changefreq>

      <priority>0.8</priority>

   </url>

    <?php }?>

</urlset>