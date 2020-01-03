<?php
echo "<div class='wrapper'>			
	<div class='header-logo'>";
		  $iden = $this->model_utama->view('identitas')->row_array();
		  $logo = $this->model_utama->view_ordering_limit('logo','id_logo','DESC',0,1);
		  foreach ($logo->result_array() as $row) {
			
          } 
?>

<div id="header-container">
<div class="subheader">
<div class="subheader-inner">
<div class="subheader-left">
<a href="https://bospediaku.blogspot.com/">Download Template Tokopedia</a>
</div>
<div class="subheader-right">
<a href="#">Mulai Berlanja</a>
<a href="#">Promo</a>
<a href="#">Testimoni</a>
<a href="#">Pusat Bantuan</a>
</div>
</div>
</div>
<header id="header-wrapper" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
<div class="header section" id="header"><div class="widget Header" data-version="2" id="Header1">
<div class="header-widget">
<?php echo "<a href='".base_url()."'><img class=' ls-is-cached lazyloaded' data-height='90' data-width='272' src='".base_url()."asset/logo/$row[gambar]'/></a>"; ?>
</div>
</div></div>
<!-- MENU LINK -->
<a class="icon_menu" href="javascript:void(0);" onclick="openNav();menuoverlayOn();addClassBody();" title="Menu"></a>
<nav>
<div class="cssmenu" id="mynav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
<div class="dropdown">
<button class="dropbtn">Kategori <i class="fa fa-angle-down"></i>
</button>
<div class="dropdown-content section" id="dropdown-content" name="Widget Profile"><div class="widget Label" data-version="2" id="Label1">
<div class="widget-title">
<h3 class="title">
Label
</h3>
</div>
<div class="widget-content list-label">
<ul>
<li>
<a class="label-name" href="https://bospediaku.blogspot.com/search/label/Hijab">
Hijab
<span class="label-count">18</span>
</a>
</li>
</ul>
<a class="allProduct" href="/search?max-results=12"><b>Semua</b> Produk <i class="fa fa-angle-right"></i></a>
</div>
</div></div>
</div>
</div>
<a class="closebtn" href="javascript:void(0)" onclick="closeNav()"></a>
</nav>
<div id="menuoverlay" onclick="closeNav();menuoverlayOff();removeClassBody()"></div>
<!-- MENU SEARCH -->
<div class="search-icon">
<form action="/search" id="search_mini_form" method="get">
<input autocomplete="off" class="input-search" name="q" placeholder="Cari produk atau toko" type="text" value="">
<input name="max-results" type="hidden" value="0">
<i class="rianseo-tutup"></i>
<button class="button"><i></i></button>
</form>
<!-- search-populart -->
<div class="search-content section" id="search-content" name="Pencarian"><div class="widget Label" data-version="2" id="Label4">
<div class="widget-title">
<h3 class="title">
Pencarian Populer
</h3>
</div>
<div class="widget-content cloud-label">
<ul>
<li>
<a class="label-name" href="https://bospediaku.blogspot.com/search/label/Hijab">
Hijab
</a>
</li>
</ul>
</div>
</div></div>
</div>
<!-- MENU LINK KANAN -->
<div class="link-right">
<div class="toko-profil section" id="toko-profil" name="Widget Profile"><div class="widget HTML" data-version="2" id="HTML7">
<div class="widget-title">
<h3 class="title">
Profil Admin
</h3>
</div>
<div class="widget-content">
<a href="#"><img class=" ls-is-cached lazyloaded" itemprop="image" src="data:image/png;base64,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"></a>
<ul class="dropdown">
<li><a href="/p/about.html" title="About">About</a></li>
<li><a href="/" title="Blog">Blog</a></li>
<li><a href="/search/label/Artikel" title="Contoh tulisan">Artikel</a></li>
<li><a href="/p/privacy-policy.html" title="Privacy Policy">Privacy Policy</a></li>
</ul>
</div>
</div></div>
<li><a href="/p/kontak.html"><i class="icon-envelope"></i>
</a></li>
</div>
<div class="clear"></div>
</header>
</div>