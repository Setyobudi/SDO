<?php
$rows = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM `rb_reseller` a JOIN rb_kota b ON a.kota_id=b.kota_id
JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id where a.id_reseller='$record[id_reseller]'")->row_array();

        if ($record['gambar'] != ''){ 
            $ex = explode(';',$record['gambar']);
            $hitungex = count($ex);
            for($i=0; $i<1; $i++){
                if (file_exists("asset/foto_produk/".$ex[$i])) { 
                    if ($ex[$i]==''){
                        $gambar = "<img style='height:120px; width:100%;  border:1px solid #cecece' src='".base_url()."asset/foto_produk/no-image.jpg'>";
                    }else{
                        $gambar = "<a target='_BLANK'  href='".base_url()."asset/foto_produk/".$ex[$i]."'><img class='' style='width:100%; border:1px solid #cecece' src='".base_url()."asset/foto_produk/".$ex[$i]."'></a>";
                    }
                }else{
                    $gambar = "<img style='height:120px; width:100%;  border:1px solid #cecece' src='".base_url()."asset/foto_produk/no-image.jpg'>";
                }
            }

            
            for($i=1; $i<$hitungex; $i++){
                if (file_exists("asset/foto_produk/".$ex[$i])) { 
                    if ($ex[$i]==''){
                        $gambarr = "<img style='width:24%; border:1px solid #fff' src='".base_url()."asset/foto_produk/no-image.jpg'>";
                    }else{
                        $gambarr = "<a target='_BLANK'  href='".base_url()."asset/foto_produk/".$ex[$i]."'><img class='' style='width:24%; border:1px solid #fff' src='".base_url()."asset/foto_produk/".$ex[$i]."'></a>";
                    }
                }else{
                    $gambarr = "<img style='width:24%;  border:2px solid #fff' src='".base_url()."asset/foto_produk/no-image.jpg'>";
                }
            }
           
        }else{
            
        }
        $kat = $this->model_app->view_where('rb_kategori_produk',array('id_kategori_produk'=>$record['id_kategori_produk']))->row_array();
        $jual = $this->model_reseller->jual_reseller($record['id_reseller'],$record['id_produk'])->row_array();
        $beli = $this->model_reseller->beli_reseller($record['id_reseller'],$record['id_produk'])->row_array();
        $disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$record[id_produk]'")->row_array();
        $diskon = rupiah(($disk['diskon']/$record['harga_konsumen'])*100,0)."%";
        if ($disk['diskon']>0){ $diskon_persen = "<div class='stok-habis'>$diskon</div>"; }else{ $diskon_persen = ''; }
        if ($disk['diskon']>=1){ 
          $harga_konsumen =  "Rp ".rupiah($record['harga_konsumen']-$disk['diskon']);
          $harga_asli = "Rp ".rupiah($record['harga_konsumen']);
          $hargajadi = "<del style='color:#8a8a8a'>$harga_asli</del><h1>$harga_konsumen</h1>/$record[satuan]";
        }else{
          $harga_konsumen =  "Rp ".rupiah($record['harga_konsumen']);
          $harga_asli = "";
          $hargajadi = $harga_konsumen."/".$record[satuan];
        }
 ?>

            <?php 
            if ($this->session->level=='konsumen'){
                echo "<form action='".base_url()."members/keranjang/$record[id_reseller]/$record[id_produk]' method='POST'>";
            }else{
                echo "<form action='".base_url()."produk/keranjang/$record[id_reseller]/$record[id_produk]' method='POST'>";
            }
            
                if (($beli['beli']-$jual['jual'])>=1){
                    #echo "<tr><td style='font-weight:bold'>Tersedia</td> <td class='text-success'>".($beli['beli']-$jual['jual'])." stok barang</td></tr>";
                }else{
                    #echo "<tr><td style='font-weight:bold'>Stok</td> <td>Tidak Tersedia</td></tr>";
                }
?>


<div id="post-wrapper-produk">
<div class="post-container-produk">
<div class="main section" id="main"><div class="widget Blog" data-version="1" id="Blog1">
<div class="blog-posts" style="margin-top:20px">
<!--Can't find substitution for tag [defaultAdStart]-->
<div class="post-outer-produk">
<section class="post-produk">
<div class="post-body entry-content">
<div class="judul-produk2">
<h1 class="post-title-produk entry-title">
<?php echo $record[nama_produk] ?>
</h1>
</div>
<div class="gambar-produk">
<?php echo $gambar; echo $gambarr; ?>
</div>
<div class="status-produk2">

<?php echo $diskon_persen ?></div>

<div class="detail-produk">
<div content="IDR">
</div>
<div class="harga-produk2">
<h1><?php echo $hargajadi ?></div></h1>
</div>
<div class="rating-produk2">
<span class="skor" itemprop="ratingValue">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-half"></i>
</span>
<span class="rating">8</span>
</div>
<div class="detail-produk">
<table><tbody>
<tr><td colspan="2">Detail Produk</td> </tr>
<tr><td style='font-weight:bold'>Penjual</td><td><?php echo "<a href='".base_url()."produk/produk_reseller/$rows[id_reseller]'>";echo $rows[nama_reseller]; ?></td></tr>
<tr><td style='font-weight:bold'>Berat</td><td><?php echo $record[berat]; ?> Gram</td></tr>
<tr><td style='font-weight:bold'>Kategori</td><td><?php echo "<a href='".base_url()."produk/kategori/$kat[kategori_seo]'>$kat[nama_kategori]</a>"; ?></td></tr>
<tr><td style='font-weight:bold'>Jenis</td><td><?php echo $record[tipe]; ?></td></tr>
<?php if (($beli['beli']-$jual['jual'])>=1){
            echo "<tr><td style='font-weight:bold'>Tersedia</td> <td class='text-success'>".($beli['beli']-$jual['jual'])." stok barang</td></tr>";
            }else{
            echo "<tr><td style='font-weight:bold'>Stok</td> <td>Tidak Tersedia</td></tr>";
            }
?>
<tr><td style='font-weight:bold'>Jumlah Beli</td> <td><input type='number' value='1' name='qty'></td></tr>
</tbody></table>
</div>
<div class="deskripsi-produk">
<br>
<br>
<br>
<section class="tabs">  
<input checked="checked" class="tab-selector-1" id="tab-1" name="radio-set" type="radio">  
<label class="tab-label-1" for="tab-1">Rincian</label>  
<input class="tab-selector-2" id="tab-2" name="radio-set" type="radio">  
<label class="tab-label-2" for="tab-2">Garansi</label>  
<input class="tab-selector-3" id="tab-3" name="radio-set" type="radio">  
<label class="tab-label-3" for="tab-3">Gratis Ongkir</label>  
<div class="content" style="background-color: transparent;">
    <div class="content-1">
            <?php echo $record[keterangan] ?>
    </div>
<div class="content-2">
<b style="background-color: white; border: 0px; box-sizing: border-box; color: #656565; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-stretch: inherit; font-variant-east-asian: inherit; font-variant-numeric: inherit; line-height: inherit; margin: 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Nikmati layanan GRATIS pengembalian dalam 30 hari untuk produk ini!</b><br>
<ul style="background-color: white; border: 0px; box-sizing: border-box; color: #656565; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-stretch: inherit; font-variant-east-asian: inherit; font-variant-numeric: inherit; line-height: 1.4em; margin: 0.5em 0em 0.5em 3em; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Alfamart, Alfamidi, dan Dan+Dan powered by Alfatrex terdekatmu (hanya wilayah JABODETABEK)</li>
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Kantor PT Pos Indonesia (bukan Agent PT Pos)</li>
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Popbox</li>
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">JNE, TIKI atau pengiriman logistik lainnya</li>
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Layanan pick-up dengan SiCepat (layanan ini tidak berlaku untuk hari minggu dan hari libur nasional).</li>
</ul>
<b style="background-color: white; border: 0px; box-sizing: border-box; color: #656565; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-stretch: inherit; font-variant-east-asian: inherit; font-variant-numeric: inherit; line-height: inherit; margin: 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Penukaran/Exchange tidak berlaku untuk produk yang dikirim dari luar negeri</b></div>
<div class="content-3">
<ol style="background-color: white; border: 0px; box-sizing: border-box; color: #656565; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-stretch: inherit; font-variant-east-asian: inherit; font-variant-numeric: inherit; line-height: inherit; margin: 0.5em 0em 0.5em 3em; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">GRATIS biaya pengiriman dengan total belanja produk di atas&nbsp;<b style="border: 0px; box-sizing: border-box; font-family: inherit; font-size: inherit; font-stretch: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; margin: 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Rp 300.000</b>&nbsp;atau produk dijual oleh SELLER di atas&nbsp;<b style="border: 0px; box-sizing: border-box; font-family: inherit; font-size: inherit; font-stretch: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; margin: 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Rp 200.000</b></li>
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Total order dihitung terpisah antara barang yang dijual &amp; dijual oleh SELLER</li>
<li style="border: 0px; box-sizing: border-box; font: inherit; margin: 0.5em 0px; max-height: 1e+07em; padding: 0px; vertical-align: baseline;">Nikmati layanan Pengiriman Ekspres untuk kota-kota besar di Indonesia dengan metode COD, Bank Transfer - Virtual Account dan Kartu Kredit dengan melakukan pembayaran sebelum jam 11.00 WIB. Cek info lebih lanjut disini.</li>
</ol>
</div>
</div>
</section>
</div>

<?php 
if (trim($rows['foto'])==''){ $foto_user = 'users.gif'; }else{ $foto_user = $rows['foto']; } 
if($rows[verified]=='Y') { 
    $status = "<img style='width: 15px; height: 15px;' src='http://localhost/market/asset/images/verif.png' width='5px' title='Terverifikasi'>"; 
}
?>
<div class="tombol-beli">
<div class="beli-lewat-chat">
<div id="admin">
<?php echo "<img class='lazyloaded' src='".base_url()."asset/foto_user/$foto_user'>"; ?>
<div class="info-admin">
<?php echo "<a href='".base_url()."produk/produk_reseller/$rows[id_reseller]' >"; ?>
<span itemprop="name"><?php echo $rows[nama_reseller] ?></span></a><?php echo " ".$status; ?>
<p><?php echo $rows[nama_kota] ?></p>
</div>
<div class="follow-admin"><a href="">Follow</a>
</div>
</div>
<a class="chat-phone">
<i aria-hidden="true" class="fa fa-shopping-cart"></i><button style='color:white;' type='submit'> Beli Sekarang </button>
</a>
<a class="chat-sms" href="sms:081214415967" target="_top">
<i aria-hidden="true" class="fa fa-heart"></i>Wishlist
</a>
<a class="chat-wa" href="#popup" target="_top">
<i aria-hidden="true" class="fa fa-whatsapp"></i> WhatsApp</a>
<!--<h3>Beli Sekarang :</h3>
<button type='submit'><a type='button' class="chat-sms" type="submit">
<i aria-hidden="true" class="fa fa-envelope"></i>Beli Sekarang</a></button>
<a class="chat-wa" href="#popup" target="_top">
<i aria-hidden="true" class="fa fa-whatsapp"></i> WhatsApp</a> -->
</div>
</div>
</form>
<div style="clear: both;"></div>

<div id="share-container">
<div id="share">
<a class="facebook" href="https://www.facebook.com/sharer.php?u=https://bospediaku.blogspot.com/2019/08/hijab-syari.html" rel="nofollow" target="blank"><i class="fa fa-facebook"></i></a>
<a class="twitter" href="https://twitter.com/share?url=https://bospediaku.blogspot.com/2019/08/hijab-syari.html" rel="nofollow" target="blank"><i class="fa fa-twitter"></i></a>
<a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://bospediaku.blogspot.com/2019/08/hijab-syari.html&amp;title=Hijab Syari&amp;summary=" rel="nofollow" target="blank"><i class="fa fa-linkedin"></i></a>
<a class="pinterest" href="https://pinterest.com/pin/create/button/?url=https://bospediaku.blogspot.com/2019/08/hijab-syari.html&amp;media=https://1.bp.blogspot.com/-NMcYtWePzic/XUSwONUhJ0I/AAAAAAAAA3A/_3hqxS3DxEodJXnkI1yw_amCe5PkAdItQCLcBGAs/s1600/beli-hijab-online-terbaru.jpg&amp;description=Hijab Syari" rel="nofollow" target="blank"><i class="fa fa-pinterest-p"></i></a>
<a class="whatsapp" data-action="share/whatsapp/share" href="https://api.whatsapp.com/send?text=Hijab Syari | https://bospediaku.blogspot.com/2019/08/hijab-syari.html"><i aria-hidden="true" class="fa fa-whatsapp"></i></a>
</div>
</div>
<div class="related-post">
    <div class="judul-produk-lainnya">
        <h3></h3></div>
        <ul class="related-post-style-3">
            <li class="related-post-item" tabindex="0">
                <a class="related-post-item-thumbnail" href="https://bospediaku.blogspot.com/2019/08/hijab-pinky.html">
                <img alt="" src="//1.bp.blogspot.com/-1pEd0Mht-2o/XUSz9NcEHvI/AAAAAAAAA30/7PAoZcbe0-AM1335GnTwmJzYr8BKKtt8gCLcBGAs/s300/beli-hijab-model-terbaru-2019.png" width="300"></a>
                <div class="related-post-item-tooltip">
                    <a class="related-post-item-title" title="Hijab Pinky" href="https://bospediaku.blogspot.com/2019/08/hijab-pinky.html">Hijab Pinky</a>
                </div>
                <span style="display:block;clear:both;"></span>
            </li>
        </ul><span style="display:block;clear:both;"></span>
    </div>
<div class="popup-wrapper" id="popup">
<div class="popup-container">
<div class="container-contact100">
<div class="wrap-contact100">
<h2 class="title-beli">
<span class="contact100-form-title"><i class="fa fa-whatsapp"></i>
<b>Beli</b> via WhatsApp </span>
<a class="popup-close" href="#closed">×</a>
</h2>
<form class="contact100-form validate-form" id="whatsapp">
<div class="rianseo-area">
<div class="rianseo-img">
<img alt="Hijab Syari" src="https://1.bp.blogspot.com/-NMcYtWePzic/XUSwONUhJ0I/AAAAAAAAA3A/_3hqxS3DxEodJXnkI1yw_amCe5PkAdItQCLcBGAs/w100/beli-hijab-online-terbaru.jpg">
</div>
<div class="rianseo-infoku">
<h3>Hijab Syari</h3>
<br>
<br>
<span style="color:#555;font-size:13px;">Kategori:</span>
<span class="rianseo-i"><a href="https://bospediaku.blogspot.com/search/label/Hijab" rel="tag">Hijab</a>, <a href="https://bospediaku.blogspot.com/search/label/Merah" rel="tag">Merah</a></span><br>
<span class="rianseo-i">*<i>Pesanan Akan di Proses</i>
<b>Via WhatsApp</b></span>
</div>
</div>
<input class="tujuan" id="noAdmin" type="hidden" value="085600066661">
<div class="wrap-input100">
<span class="label-input100">Nama</span>
<label><input class="input100 nama" placeholder="Masukkan nama Anda" type="text"></label>
<span class="focus-input100"></span></div>
<div class="wrap-input100">
<span class="label-input100">Nama Produk</span>
<label><input class="input100 produkk" type="text" value=""></label>
<span class="focus-input100"></span>
</div>
<div class="wrap-input100">
<span class="label-input100">Nomor HP</span>
<label>
<input class="input100 nowhatsapp" placeholder="Tulis nomor HP Anda" type="text">
</label>
<span class="focus-input100"></span>
</div>
<div class="wrap-input100">
<span class="label-input100"><i class="fa fa-calculator"></i> Jumlah Produk</span>
<label>
<input class="input100 jorder" type="text" value="1">
</label>
<span class="focus-input100"></span>
</div>
<div class="wrap-input100">
<span class="label-input100"><i class="fa fa-truck"></i> Opsi Pengiriman:</span>
<label>
<input class="input100 kurir" placeholder="contoh: JNE, TIKI, JNT dll" type="text">
</label>
<span class="focus-input100"></span>
</div>
<div class="wrap-input100">
<span class="label-input100"><i class="fas fa-map-marker-alt"></i> Alamat lengkap</span>
<label>
<textarea class="input100 alamat" placeholder="Masukkan alamat lengkap Anda"></textarea>
</label>
<span class="focus-input100"></span>
</div>
<div class="container-contact100-form-btn">
<div class="wrap-contact100-form-btn">
<div class="contact100-form-bgbtn"></div>
<a class="contact100-form-btn submit" onclick="redirect('/p/terimakasih.html')">Kirim <i class="fa fa-whatsapp"></i></a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
  
<div style="clear: both;"></div>
</section>
</div>
<!--Can't find substitution for tag [adEnd]-->
</div>
<div class="clear"></div>
<div class="clear"></div>
</div></div>
</div>
</div>
<!-- sidebar wrapper -->
<div id='sidebar-wrapper' itemscope='itemscope' itemtype='https://schema.org/WPSideBar'>
<div class='sidebar-container'>
<?php include "sidebar.php" ?>
</div>
</div>
<div class='clear'></div>
</div>
<!-- post wrapper end -->
<!-- fiktur start -->
<div class='clear'>
