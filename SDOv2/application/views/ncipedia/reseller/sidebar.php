<div class='sidebar section' id='sidebar'><div class='widget Label' data-version='2' id='Label2'>
<div class='widget-title'>
<h3 class='title'>
Kategori
</h3>
</div>
<div class='widget-content list-label'>
<?php 
    $kategori = $this->model_app->view('rb_kategori_produk');
    $jumlah = $this->db->query("SELECT COUNT(*) FROM rb_produk WHERE id_kategori_produk=16");
	foreach ($kategori->result_array() as $rows) {
        $h = $this->db->query("SELECT COUNT(*) as jumlah FROM rb_produk WHERE id_kategori_produk=$rows[id_kategori_produk]")->row_array();
	    echo "<ul><li><a class='label-name' href='".base_url()."produk/kategori/$rows[kategori_seo]'>$rows[nama_kategori]<span class='label-count'>$h[jumlah]</span></a></li>";
	}	
echo "</ul>";
?>
</div>
</div>
</div>
<div class='sidebar-sticky section' id='sidebar-sticky'><div class='widget HTML' data-version='2' id='HTML5'>
<div class='widget-title'>
<h3 class='title'>
Dukungan Pengiriman
</h3>
</div>
<div class='widget-content'>
<b:if cond='data:blog.pageType == &quot;item&quot;'>
<div class="rvm-shipping-support">
<div class="rvm-shipping-support-img">
<img class="lazyload" src="https://1.bp.blogspot.com/-42PkdIi_4ZM/XTkVhI4pJnI/AAAAAAAADYg/AIOezFVd_RUy94NSjhZ5MSMmqfqio0DkwCPcBGAYYCw/s1600/kurir-jne.png" alt="JNE" title="JNE" />
</div>
<div class="rvm-shipping-support-title">
<ul class="rvm-shipping-options">
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">Reguler</span></li>
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">OKE</span></li>
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">YES</span></li>
</ul>
</div>
</div>
<div class="rvm-shipping-support">
<div class="rvm-shipping-support-img">
<img class="lazyload" src="https://1.bp.blogspot.com/-aO1lo244Sno/XTkVlXjeMtI/AAAAAAAADYk/nb5TYXo1sMIiXFRTGM67uhM_Qpmm72vpACPcBGAYYCw/s1600/kurir-tiki.png" alt="TIKI" title="TIKI" />
</div>
<div class="rvm-shipping-support-title">
<ul class="rvm-shipping-options">
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">Reguler</span></li>
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">Over Night Service</span></li>
</ul>
</div>
</div>
<div class="rvm-shipping-support">
<div class="rvm-shipping-support-img">
<img class="lazyload" src="https://1.bp.blogspot.com/-sLHUWTceKL8/XTkVpu2oW-I/AAAAAAAADYs/RD5TNrxyxQwZ_vA4mVqPLtRtmgCjQJoXwCPcBGAYYCw/s1600/kurir-grab.png" alt="Grab" title="Grab" />
</div>
<div class="rvm-shipping-support-title">
<ul class="rvm-shipping-options">
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">Instant Courier</span></li>
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">Same Day</span></li>
</ul>
</div>
</div>
<div class="rvm-shipping-support">
<div class="rvm-shipping-support-img">
<img class="lazyload" src="https://1.bp.blogspot.com/-LZmYGvdCfkI/XTkVrRCdsvI/AAAAAAAADYw/7qfe9IZkRvggCVGpDbBs1sqLx67tVLIwgCPcBGAYYCw/s1600/kurir-jnt.png" alt="J&amp;T" title="J&amp;T" />
</div>
<div class="rvm-shipping-support-title">
<ul class="rvm-shipping-options">
<li><i class="svg_icon__tick_grey"></i><span class="inline-block va-middle">Reguler</span></li>
</ul>
</div>
</div>
</b:if>
</div>
</div><div class='widget PopularPosts' data-version='2' id='PopularPosts1'>
<div class='widget-title'>
<h3 class='title'>
Produk Terlaris
</h3>
</div>
<div class='widget-content'>
<div class='post post-shop-info' data-id='9005591769399248071'>
<div class='post-content'>
<a class='post-image-link' href='https://bospediaku.blogspot.com/2019/08/hijab-syari.html'>
<img alt='Hijab Syari' class='post-thumb lazyload' src='https://1.bp.blogspot.com/-NMcYtWePzic/XUSwONUhJ0I/AAAAAAAAA3A/_3hqxS3DxEodJXnkI1yw_amCe5PkAdItQCLcBGAs/w70/beli-hijab-online-terbaru.jpg'/>
</a>
<div class='product-info'>
<h2 class='post-title'>
<a href='https://bospediaku.blogspot.com/2019/08/hijab-syari.html'>Hijab Syari</a>
</h2>
<span class='harga-produk'></span>
</div>
</div>
</div>
<div class='post post-shop-info' data-id='1745193831625432247'>
<div class='post-content'>
<a class='post-image-link' href='https://bospediaku.blogspot.com/2019/08/hijab-pinky.html'>
<img alt='Hijab Pinky' class='post-thumb lazyload' src='https://1.bp.blogspot.com/-1pEd0Mht-2o/XUSz9NcEHvI/AAAAAAAAA30/7PAoZcbe0-AM1335GnTwmJzYr8BKKtt8gCLcBGAs/w70/beli-hijab-model-terbaru-2019.png'/>
</a>
<div class='product-info'>
<h2 class='post-title'>
<a href='https://bospediaku.blogspot.com/2019/08/hijab-pinky.html'>Hijab Pinky</a>
</h2>
<span class='harga-produk'></span>
</div>
</div>
</div>
<div class='post post-shop-info' data-id='2633293838984139576'>
<div class='post-content'>
<a class='post-image-link' href='https://bospediaku.blogspot.com/2019/08/hijab-syahrini.html'>
<img alt='Hijab Syahrini' class='post-thumb lazyload' src='https://1.bp.blogspot.com/-XeohoEBiezQ/XUSwPBSsd5I/AAAAAAAAA3M/Xft1QxbNlqArTOWGq67VuLmh4WiUblV2ACLcBGAs/w70/hura-anggun.jpg'/>
</a>
<div class='product-info'>
<h2 class='post-title'>
<a href='https://bospediaku.blogspot.com/2019/08/hijab-syahrini.html'>Hijab Syahrini</a>
</h2>
<span class='harga-produk'></span>
</div>
</div>
</div>
</div>
</div></div>