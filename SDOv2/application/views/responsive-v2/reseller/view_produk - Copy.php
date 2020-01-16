<section id="content">   	
<div class="md-margin"></div><!-- .space -->
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="row">
        					<div class="col-md-9 col-sm-8 col-xs-12 main-content">
        						<div class="category-toolbar clearfix">
									<div class="toolbox-filter clearfix">
										<div class="sort-box">
											<span class="separator"><?php echo $judul ?></span>
										</div>
									</div><!-- End .toolbox-filter -->
        						</div><!-- End .category-toolbar -->
        						<div class="md-margin"></div><!-- .space -->
        						<div class="category-item-container">
                                <div class="row">
                                <?php 
  
  $no = 1;
  if (($this->input->post('kata'))){
  
  }
    foreach ($record->result_array() as $row){
        $ex = explode(';', $row['gambar']);
	    if (trim($ex[0])==''){ 
            $foto_produk = 'no-produk.png';
            $foto_produk_hover = 'no-produk.png';
        }else{
             $foto_produk = $ex[0];
             $foto_produk_hover = $ex[1]; 
        }
	    if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,20).',..';  }else{ $judul = $row['nama_produk']; }
	    $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
	    $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();
	    if ($beli['beli']-$jual['jual']<=0){ $stok = '<b style="color:#000">Stok Habis</b>'; }else{ $stok = "<span style='color:green'>Stok ".($beli['beli']-$jual['jual'])." $row[satuan]</span>"; }

	    $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
	    $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)."%";
	    if ($diskon>0){ $diskon_persen = "<span class='discount-rect'>$diskon</span>"; }else{ $diskon_persen = ''; }
	    if ($diskon>=1){ 
	    	$harga =  "<del style='color:#8a8a8a'><small>Rp ".rupiah($row['harga_konsumen'])."</small></del> Rp ".rupiah($row['harga_konsumen']-$disk['diskon']);
	    }else{
	    	$harga =  "Rp ".rupiah($row['harga_konsumen']);
	    }
        echo "<div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='item item-hover'>
            <div class='item-image-wrapper'>
                <figure class='item-image-container'>
                    <a href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]'>
                    <img class='item-image' style=' min-height:195px; width:100%' src='".base_url()."asset/foto_produk/$foto_produk'>
                    <img class='item-image-hover' style=' min-height:195px; width:100%' src='".base_url()."asset/foto_produk/$foto_produk_hover'>
                    </a>
                </figure>
                <!-- <div class='item-price-container'>
                    <span class='item-price'><%= number_to_currency(row['harga_konsumen'], unit: 'Rp. ', separator: ',', delimiter: '.', precision:0) %></span>
                    </div> End .item-price-container -->
                <!-- <span class='new-rect'>New</span> -->
                $diskon_persen
            </div><!-- End .item-image-wrapper -->
            <div class='item-meta-container'>
                <div class='ratings-container'>
                    <div class='ratings'>
                        <div class='ratings-result' data-result='80'></div>
                    </div><!-- End .ratings -->
                    <span class='ratings-amount'>
                        5 Reviews
                    </span>
                </div><!-- End .rating-container -->
                <h3 class='item-name'><a href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]'>$judul</a></h3>
                    <h5><span>$harga</span></h4>
                <div class='item-action'>
                    <a href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]' class='item-add-btn'>
                        <span class='icon-cart-text'><i class='fa fa-shopping-cart'> Beli</i></span>
                    </a>
                    <div class='item-action-inner'>
                        <a href='#' class='icon-button icon-like'>Favourite</a>
                        <a href='#' class='icon-button icon-compare'>Checkout</a>
                    </div><!-- End .item-action-inner -->
                </div><!-- End .item-action -->
            </div><!-- End .item-meta-container --> 
        </div><!-- End .item -->
	</div><!-- End .col-md-4 -->";

	$no++;
    }
    echo "</div><div class='pagination-container clearfix'>";
        echo "<div class='pull-right'>";
            echo $this->pagination->create_links();
        echo "</div>";
    echo "</div>
  <div style='clear:both'><br>";
?>
                                </div><!-- End .row -->
                                </div><!-- End .category-item-container -->
        					</div><!-- End .col-md-9 -->
        					
        					<aside class="col-md-3 col-sm-4 col-xs-12 sidebar">
        						<div class="widget">
        							<div class="panel-group custom-accordion sm-accordion" id="category-filter">
										<div class="panel">
											<div class="accordion-header">
												<div class="accordion-title"><span>Kategori</span></div><!-- End .accordion-title -->
									<a class="accordion-btn opened"  data-toggle="collapse" data-target="#category-list-1"></a>
											</div><!-- End .accordion-header -->
								
										<div id="category-list-1" class="collapse in">
											<div class="panel-body">
                                                <ul class="category-filter-list jscrollpane">
                                                <?php 
                                                    $kategori = $this->model_app->view('rb_kategori_produk');
                                                    $jumlah = $this->db->query("SELECT COUNT(*) FROM rb_produk WHERE id_kategori_produk=16");
                                                    foreach ($kategori->result_array() as $rows) {
                                                        $h = $this->db->query("SELECT COUNT(*) as jumlah FROM rb_produk WHERE id_kategori_produk=$rows[id_kategori_produk]")->row_array();
                                                        echo "<li><a href='".base_url()."produk/kategori/$rows[kategori_seo]'>$rows[nama_kategori] ( $h[jumlah] )</a></li>";
                                                    }
                                                ?>
												</ul>
											</div><!-- End .panel-body -->
										</div><!-- #collapse -->
										</div><!-- End .panel -->
        								
        								<div class="panel">
											<div class="accordion-header">
												<div class="accordion-title"><span>Brand</span></div><!-- End .accordion-title -->
									<a class="accordion-btn opened"  data-toggle="collapse" data-target="#category-list-2"></a>
											</div><!-- End .accordion-header -->
								
										<div id="category-list-2" class="collapse in">
											<div class="panel-body">
											<ul class="category-filter-list jscrollpane">
												<li><a href="#">Samsung (50)</a></li>
												<li><a href="#">Apple (80)</a></li>
												<li><a href="#">HTC (20)</a></li>
												<li><a href="#">Motoroloa (20)</a></li>
												<li><a href="#">Nokia (11)</a></li>
											</ul>
											</div><!-- End .panel-body -->
										</div><!-- #collapse -->
										</div><!-- End .panel -->
        							
        							<div class="panel">
											<div class="accordion-header">
												<div class="accordion-title"><span>Price</span></div><!-- End .accordion-title -->
									<a class="accordion-btn opened"  data-toggle="collapse" data-target="#category-list-3"></a>
											</div><!-- End .accordion-header -->
								
										<div id="category-list-3" class="collapse in">
											<div class="panel-body">
												<div id="price-range">
													
												</div><!-- End #price-range -->
												<div id="price-range-details">
													<span class="sm-separator">from</span>
													<input type="text" id="price-range-low" class="separator">
													<span class="sm-separator">to</span>
													<input type="text" id="price-range-high">
												</div>
												<div id="price-range-btns">
													<a href="#" class="btn btn-custom-2 btn-sm">Ok</a>
													<a href="#" class="btn btn-custom-2 btn-sm">Clear</a>
												</div>
												
											</div><!-- End .panel-body -->
										</div><!-- #collapse -->
										</div><!-- End .panel -->
        							
        							<div class="panel">
											<div class="accordion-header">
												<div class="accordion-title"><span>Color</span></div><!-- End .accordion-title -->
									<a class="accordion-btn opened"  data-toggle="collapse" data-target="#category-list-4"></a>
											</div><!-- End .accordion-header -->
								
										<div id="category-list-4" class="collapse in">
											<div class="panel-body">
											<ul class="filter-color-list clearfix">
												<li><a href="#" data-bgcolor="#fff" class="filter-color-box"></a></li>
												<li><a href="#" data-bgcolor="#ffff33" class="filter-color-box"></a></li>
												<li><a href="#" data-bgcolor="#ff9900" class="filter-color-box"></a></li>
												<li class="last-md"><a href="#" data-bgcolor="#ff9999" class="filter-color-box"></a></li>
                                                <li class="last-lg"><a href="#" data-bgcolor="#99cc33" class="filter-color-box"></a></li>
                                                <li><a href="#" data-bgcolor="#339933" class="filter-color-box"></a></li>
                                                <li><a href="#" data-bgcolor="#ff0000" class="filter-color-box"></a></li>
                                                <li class="last-md"><a href="#" data-bgcolor="#ff3366" class="filter-color-box"></a></li>
                                                <li><a href="#" data-bgcolor="#cc33ff" class="filter-color-box"></a></li>
                                                <li class="last-lg"><a href="#" data-bgcolor="#9966cc" class="filter-color-box"></a></li>
                                                <li><a href="#" data-bgcolor="#99ccff" class="filter-color-box"></a></li>
                                                <li  class="last-md"><a href="#" data-bgcolor="#3333cc" class="filter-color-box"></a></li>
                                                <li><a href="#" data-bgcolor="#999999" class="filter-color-box"></a></li>
                                                <li><a href="#" data-bgcolor="#663300" class="filter-color-box"></a></li>
                                                <li class="last-lg"><a href="#" data-bgcolor="#000" class="filter-color-box"></a></li>
											</ul>
											</div><!-- End .panel-body -->
										</div><!-- #collapse -->
										</div><!-- End .panel -->
        							</div><!-- .panel-group -->
        						</div><!-- End .widget -->
        						
        						<div class="widget featured">
        							<h3>Featured</h3>
        							
        							<div class="featured-slider flexslider sidebarslider">
        								<ul class="featured-list clearfix">
        									<li>
        										<div class="featured-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item5.jpg" alt="item5">
        											</figure>
        											<h5><a href="#">Jacket Suiting Blazer</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$40</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        										
        										<div class="featured-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item1.jpg" alt="item1">
        											</figure>
        											<h5><a href="#">Gap Graphic Cuffed</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$18</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        										
        										<div class="featured-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item2.jpg" alt="item2">
        											</figure>
        											<h5><a href="#">Women's Lauren Dress</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$30</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        									</li>
        									<li>
        										<div class="featured-product clearfix">
        											<figure>
                                                        <img src="images/products/thumbnails/item3.jpg" alt="item3">
                                                    </figure>
        											<h5><a href="#">Swiss Mobile Phone</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="64"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$39</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        										
        										<div class="featured-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item4.jpg" alt="item4">
        											</figure>
        											<h5><a href="#">Zwinzed HeadPhones</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="94"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$18.99</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        										
        										<div class="featured-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item7.jpg" alt="item7">
        											</figure>
        											<h5><a href="#">Kless Man Suit</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="74"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$99</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        									</li>
        									<li>
        										
        										<div class="featured-product clearfix">
        											<figure>
                                                        <img src="images/products/thumbnails/item4.jpg" alt="item4">
                                                    </figure>
        											<h5><a href="#">Gap Graphic Cuffed</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$17</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        										
        										<div class="featured-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item6.jpg" alt="item6">
        											</figure>
        											<h5><a href="#">Women's Lauren Dress</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="featured-price">$30</div><!-- End .featured-price -->
        										</div><!-- End .featured-product -->
        									</li>
        								</ul>
        							</div><!-- End .featured-slider -->
        						</div><!-- End .widget -->
        						
        						<div class="widget banner-slider-container">
        							<div class="banner-slider flexslider">
        								<ul class="banner-slider-list clearfix">
        									<li><a href="#"><img src="images/banner1.jpg" alt="Banner 1"></a></li>
        									<li><a href="#"><img src="images/banner2.jpg" alt="Banner 2"></a></li>
        									<li><a href="#"><img src="images/banner3.jpg" alt="Banner 3"></a></li>
        								</ul>
        							</div>
        						</div><!-- End .widget -->
        						
        					</aside><!-- End .col-md-3 -->
        				</div><!-- End .row -->
        				
        				
        			</div><!-- End .col-md-12 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->



		<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>
        <p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>

		<div class="col-md-9 col-sm-8 col-xs-12 main-content">
		<div class="category-item-container">
        <div class="row">
			<div class='col-md-4 col-sm-6 col-xs-12'>
				<p><span class='content-placeholder' style='width:100%; min-height:195px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 54px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 18px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 35px;'>&nbsp;</span></p>
			</div><!-- End .col-md-4 -->
			<div class='col-md-4 col-sm-6 col-xs-12'>
				<p><span class='content-placeholder' style='width:100%; min-height:195px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 54px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 18px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 35px;'>&nbsp;</span></p>
			</div><!-- End .col-md-4 -->
			<div class='col-md-4 col-sm-6 col-xs-12'>
				<p><span class='content-placeholder' style='width:100%; min-height:195px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 54px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 18px;'>&nbsp;</span></p>
				<p><span class='content-placeholder' style='width:100%; height: 35px;'>&nbsp;</span></p>
			</div><!-- End .col-md-4 -->
			</div></div></div>
        </section><!-- End #content -->