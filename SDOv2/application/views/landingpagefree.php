<?php

$idprod1 = $rows[produk_id1];
$produk1 = $this->db->query("SELECT * FROM rb_produk WHERE id_produk='$idprod1'")->row_array();
$disk1 = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$idprod1'")->row_array();
    $diskon1 = rupiah(($disk1['diskon']/$produk1['harga_konsumen'])*100,0)."%";
    if ($diskon1>0){ $diskon_persen1 = "<div class='top-right'>$diskon1</div>"; }else{ $diskon_persen1 = ''; }
    if ($diskon1>=1){ 
      $harga1 =  "<del style='color:#8a8a8a'><small>Rp ".rupiah($produk1['harga_konsumen'])."</small></del> Rp ".rupiah($produk1['harga_konsumen']-$disk1['diskon']);
    }else{
      $harga1 =  "Rp ".rupiah($produk1['harga_konsumen']);
    }
/*echo $rows[foto_lp]."<br>";
echo "<img style='width:210px;' src='".base_url()."asset/img_landingpage/$rows[foto_lp]' /><br>";
echo "Toko : ".$rows[nama_tokoo]."<br>";
echo "Alamat : ".$rows[alamat_lengkap]."<br>"; */


$ex = explode(';', $produk1['gambar']);
if (trim($ex[0])==''){ $foto_produk1 = 'no-produk.png'; }else{ $foto_produk1 = $ex[0]; }

#echo " <div class='product-img' style='background-image: url(".base_url()."asset/foto_produk/$foto_produk);'>";
/* echo "<a href='".base_url()."produk/detail/$produk1[id_produk]/$produk1[produk_seo]'>".$produk1[nama_produk]."</a><br>";
echo $diskon_persen1."<br>";
echo $harga1."<br>"; */

$idprod2 = $rows[produk_id2];
$produk2 = $this->db->query("SELECT * FROM rb_produk WHERE id_produk='$idprod2'")->row_array();
$disk2 = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$idprod2'")->row_array();
    $diskon2 = rupiah(($disk2['diskon']/$produk2['harga_konsumen'])*100,0)."%";
    if ($diskon2>0){ $diskon_persen2 = "<div class='top-right'>$diskon2</div>"; }else{ $diskon_persen2 = ''; }
    if ($diskon2>=1){ 
      $harga2 =  "<del style='color:#8a8a8a'><small>Rp ".rupiah($produk2['harga_konsumen'])."</small></del> Rp ".rupiah($produk2['harga_konsumen']-$disk2['diskon']);
    }else{
      $harga2 =  "Rp ".rupiah($produk2['harga_konsumen']);
    }

$ex = explode(';', $produk2['gambar']);
if (trim($ex[0])==''){ $foto_produk2 = 'no-produk.png'; }else{ $foto_produk2 = $ex[0]; }

/* cho "<a href='".base_url()."produk/detail/$produk2[id_produk]/$produk2[produk_seo]'>".$produk2[nama_produk]."</a><br>";
echo $diskon_persen2."<br>";
echo $harga2."<br>"; */

$idprod3 = $rows[produk_id3];
$produk3 = $this->db->query("SELECT * FROM rb_produk WHERE id_produk='$idprod3'")->row_array();
$disk3 = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$idprod3'")->row_array();
    $diskon3 = rupiah(($disk3['diskon']/$produk3['harga_konsumen'])*100,0)."%";
    if ($diskon3>0){ $diskon_persen3 = "<div class='top-right'>$diskon3</div>"; }else{ $diskon_persen3 = ''; }
    if ($diskon3>=1){ 
      $harga3 =  "<del style='color:#8a8a8a'><small>Rp ".rupiah($produk3['harga_konsumen'])."</small></del> Rp ".rupiah($produk3['harga_konsumen']-$disk3['diskon']);
    }else{
      $harga3 =  "Rp ".rupiah($produk3['harga_konsumen']);
    }

$ex = explode(';', $produk3['gambar']);
if (trim($ex[0])==''){ $foto_produk3 = 'no-produk.png'; }else{ $foto_produk3 = $ex[0]; }

/* echo "<a href='".base_url()."produk/detail/$produk3[id_produk]/$produk3[produk_seo]'>".$produk3[nama_produk]."</a><br>";
echo $diskon_persen3."<br>";
echo $harga3."<br>";

echo "<br><br>"; */

$berita = $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 4");
/* foreach($berita->result_array() as $r){
    echo "<a href='".base_url()."$r[judul_seo]'>".$r[judul]."<br>";
    if ($r['gambar'] == ''){
        echo "<img style='width:210px;' src='".base_url()."asset/foto_berita/no-image.jpg' alt='no-image.jpg' /></a><br>";
    }else{
        echo "<img style='width:210px;' src='".base_url()."asset/foto_berita/$r[gambar]' alt='$r[gambar]' /></a><br>";
    }
} */


$jumlahprodukterjual = $this->db->query("SELECT COUNT(*) as total FROM rb_penjualan WHERE id_penjual='$rows[id_reseller]'")->row_array();
$jumlahproduk = $this->db->query("SELECT COUNT(*) as total FROM rb_produk WHERE id_reseller='$rows[id_reseller]'")->row_array();
//echo "Jumlah produk  = ".$jumlahproduk[total]."<br>";
//echo "Jumlah produk terjual = ".$jumlahprodukterjual[total]."<br>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo "Landingpage - ".$rows[nama_tokoo]; ?></title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>asset/landingpage/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/landingpage/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/landingpage/css/animate.css">
  <link href="<?php echo base_url(); ?>asset/landingpage/css/prettyPhoto.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>asset/landingpage/css/style.css" rel="stylesheet" />
  <!-- =======================================================
    Theme Name: Company
    Theme URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
            <div class="navbar-brand">
              <a href=""><h1><span><?php echo $rows[nama_tokoo]; ?></h1></a>
            </div>
          </div>

          <div class="navbar-collapse collapse">
            <div class="menu">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="index.html" class="active">Home</a></li>
                <li role="presentation"><a href="about.html">About Us</a></li>
                <li role="presentation"><a href="services.html">Services</a></li>
                <li role="presentation"><a href="portfolio.html">Portfolio</a></li>
                <li role="presentation"><a href="blog.html">Blog</a></li>
                <li role="presentation"><a href="contact.html">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <section id="main-slider" class="no-margin">
    <div class="carousel slide">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(<?php echo base_url(); ?>asset/landingpage/images/slider/bg1.jpg)">
          <div class="container">
            <div class="row slide-margin">
              <div class="col-sm-6">
                <div class="carousel-content">
                  <h2 class="animation animated-item-1">Welcome <span><?php echo $rows[nama_tokoo]; ?></span></h2>
                  <p class="animation animated-item-2"><?php echo "Toko : ".$rows[nama_tokoo]."<br>";
              echo "Alamat : ".$rows[alamat_lengkap]."<br>"; ?></p>
                  <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                </div>
              </div>

              <div class="col-sm-6 hidden-xs animation animated-item-4">
                <div class="slider-img">
                  <?php echo "<img src='".base_url()."asset/img_landingpage/$rows[foto_lp]' class='img-responsive'>"; ?>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--/.item-->
      </div>
      <!--/.carousel-inner-->
    </div>
    <!--/.carousel-->
  </section>
  <!--/#main-slider-->

  <div class="feature">
    <div class="container">
    <div class="text-center">
        <h2>Produk Kami</h2>
      </div>

      <div class="text-center">
        <div class="col-md-4">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <?php #echo "<i style='background-image: url(".base_url()."asset/foto_produk/$foto_produk);'></i>"; ?>
            <img class='img-responsive' src='<?php echo base_url();?>asset/foto_produk/<?php echo $foto_produk1; ?>'></i>"
            <h2><?php echo "<a href='".base_url()."produk/detail/$produk1[id_produk]/$produk1[produk_seo]'>".$produk1[nama_produk]."</a>"; ?></h2>
            <p><?php echo $harga1."<br>"; ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
          <img class='img-responsive' src='<?php echo base_url();?>asset/foto_produk/<?php echo $foto_produk2; ?>'></i>"
            <h2><?php echo "<a href='".base_url()."produk/detail/$produk2[id_produk]/$produk2[produk_seo]'>".$produk2[nama_produk]."</a>"; ?></h2>
            <p><?php echo $harga2."<br>"; ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">
          <img class='img-responsive' src='<?php echo base_url();?>asset/foto_produk/<?php echo $foto_produk3; ?>'></i>"
            <h2><?php echo "<a href='".base_url()."produk/detail/$produk3[id_produk]/$produk3[produk_seo]'>".$produk3[nama_produk]."</a>"; ?></h2>
            <p><?php echo $harga3."<br>"; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="about">
    <div class="container">
      <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <h2>about us</h2>
        <img src="<?php echo base_url(); ?>asset/landingpage/images/6.jpg" class="img-responsive" />
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero,
          pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
        </p>
      </div>

      <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
        <h2>Template built with Twitter Bootstrap</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero,
          pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
            libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
          </p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
            libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque </p>
      </div>
    </div>
  </div>

  <div class="lates">
    <div class="container">
    <div class="text-center">
        <h2>Artikel Terbaru</h2>
      </div>
      <?php 
    foreach($berita->result_array() as $r){
      $isi_berita =(strip_tags($r['isi_berita']));
      $isi = substr($isi_berita,0,220);
      $isi = substr($isi_berita,0,strrpos($isi," "));
      $judul = substr($r['judul'],0,33); 
      if ($r['gambar'] == ''){
          $gambar = "<img style='height:160px;' class='img-responsive' src='".base_url()."asset/foto_berita/no-image.jpg' alt='no-image.jpg' /></a><br>";
      }else{
          $gambar = "<img style='height:160px;width:250px;' class='img-responsive' src='".base_url()."asset/foto_berita/$r[gambar]' alt='$r[gambar]' /></a><br>";
      }
      echo "<div class='col-md-3 wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
      $gambar;

      <h3><a href='".base_url()."$r[judul_seo]'>".$judul." . . . </a></h3>
      <p>".getSearchTermToBold($isi,$this->input->post('kata'))." . . .</p>
      </div>";
      
    } 
    ?>
    </div>
  </div>

  <section id="partner">
    <div class="container">
      <div class="center wow fadeInDown">
        <h2>Our Partners</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
      </div>

      <div class="partners">
        <ul>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="<?php echo base_url(); ?>asset/landingpage/images/partners/partner1.png"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="<?php echo base_url(); ?>asset/landingpage/images/partners/partner2.png"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="<?php echo base_url(); ?>asset/landingpage/images/partners/partner3.png"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="<?php echo base_url(); ?>asset/landingpage/images/partners/partner4.png"></a></li>
          <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="<?php echo base_url(); ?>asset/landingpage/images/partners/partner5.png"></a></li>
        </ul>
      </div>
    </div>
    <!--/.container-->
  </section>
  <!--/#partner-->

  <section id="conatcat-info">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="pull-left">
              <i class="fa fa-phone"></i>
            </div>
            <div class="media-body">
              <h2>Have a question or need a custom quote?</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation +0123 456 70 80</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/.container-->
  </section>
  <!--/#conatcat-info-->

  <footer>
    <div class="footer">
      <div class="container">
        <div class="social-icon">
          <div class="col-md-4">
            <ul class="social-network">
              <li><a href="#" class="fb tool-tip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#" class="twitter tool-tip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#" class="gplus tool-tip" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#" class="linkedin tool-tip" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#" class="ytube tool-tip" title="You Tube"><i class="fa fa-youtube-play"></i></a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-4 col-md-offset-4">
          <div class="copyright">
            &copy; Company Theme. All Rights Reserved.
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Company
              -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a></div>
          </div>
        </div>
      </div>

      <div class="pull-right">
        <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
      </div>
    </div>
  </footer>



  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php echo base_url(); ?>asset/landingpage/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/landingpage/js/jquery-migrate.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo base_url(); ?>asset/landingpage/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/landingpage/js/jquery.prettyPhoto.js"></script>
  <script src="<?php echo base_url(); ?>asset/landingpage/js/jquery.isotope.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/landingpage/js/wow.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/landingpage/js/functions.js"></script>

</body>

</html>
