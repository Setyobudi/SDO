<div class='clear'></div>
<div id='post-wrapper'>
<div class='post-container'>


<?php 

echo "<div class='daftar-produk'>
<h2>$judul</h2></div><div class='main section' id='main'><div class='widget Blog' data-version='1' id='Blog1'>
<div class='blog-posts'>";

if ($this->uri->segment(2)=='kategori'){
  $cek = $this->model_app->edit('rb_kategori_produk',array('kategori_seo'=>$this->uri->segment(3)))->row_array();
  $jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
  if ($jumlah <= 0){
      echo "<div  style='margin:10%' class='alert alert-info'><center>Maaf, Produk pada Kategori ini belum tersedia..!</center></div>";
  }
}

if ($this->uri->segment(2)=='subkategori'){
  $cek = $this->model_app->edit('rb_kategori_produk_sub',array('kategori_seo_sub'=>$this->uri->segment(3)))->row_array();
  $jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk_sub'=>$cek['id_kategori_produk_sub']))->num_rows();
  if ($jumlah <= 0){
      echo "<div  style='margin:10%' class='alert alert-info'><center>Maaf, Produk pada Sub Kategori ini belum tersedia..!</center></div>";
  }
}

  $no = 1;
  echo "<div class='container'>";
  foreach ($record->result_array() as $row){
  $ex = explode(';', $row['gambar']);
  if (trim($ex[0])==''){ $foto_produk = 'no-produk.png'; }else{ $foto_produk = $ex[0]; }
  if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }

  $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
  $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();
  if ($beli['beli']-$jual['jual']<=0){ $stok = '<b style="color:000">Stok Habis</b>'; }else{ $stok = "<span style='color:green'>Stok ".($beli['beli']-$jual['jual'])." $row[satuan]</span>"; }

  $disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$row[id_produk]'")->row_array();
  $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)."%";
  if ($diskon>0){ $diskon_persen = "<div class='top-right'>$diskon</div>"; }else{ $diskon_persen = ''; }
  if ($diskon>=1){ 
    $harga =  "<del style='color:#8a8a8a'><small>Rp ".rupiah($row['harga_konsumen'])."</small></del> Rp ".rupiah($row['harga_konsumen']-$disk['diskon']);
  }else{
    $harga =  "Rp ".rupiah($row['harga_konsumen']);
  }
  echo "<div class='post-outer'>
              <section class='post' style=height:290px;>
	                <div class='img-thumbnail'>
	                  <a title='$row[nama_produk]' href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]'><img style=' min-height:195px; width:100%' src='".base_url()."asset/foto_produk/$foto_produk'></a>
	                  		$diskon_persen
                    </div>
                    <div class='produk-info-container'>
	                <h2 class='post-title judul-produk entry-title' itemprop='name'><a title='$row[nama_produk]' href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]'>$judul</a></h4>
                  <div class='post-body entry-content'>
                  <span class='harga-produk'>$harga</span>
                  </div>
                  <div class='rating-produk'>
                    <span class='skor'>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star-half'></i>
                    </span>
                    <span class='rating'>8</span>
                  </div></div>
	          </div>";
    $no++;
  }
echo "</div>
<div class='pagination'>";
         echo $this->pagination->create_links();
    echo "</div>";
?>

</div>
<div class='clear'></div>

<div class='clear'></div>
<div class='blog-feeds'>
<div class='feed-links'>
Subscribe to:
<a class='feed-link' href='https://bospediaku.blogspot.com/feeds/posts/default' target='_blank' type='application/atom+xml'>Posts (Atom)</a>
</div>
</div>
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

