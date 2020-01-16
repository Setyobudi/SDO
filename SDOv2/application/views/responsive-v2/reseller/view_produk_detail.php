<?php 
$rows = $this->db->query("SELECT * FROM rb_reseller where id_reseller='$record[id_reseller]'")->row_array();
$kat = $this->model_app->view_where('rb_kategori_produk',array('id_kategori_produk'=>$record['id_kategori_produk']))->row_array();
        $jual = $this->model_reseller->jual_reseller($record['id_reseller'],$record['id_produk'])->row_array();
        $beli = $this->model_reseller->beli_reseller($record['id_reseller'],$record['id_produk'])->row_array();
        $disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$record[id_produk]'")->row_array();
        $diskon = rupiah(($disk['diskon']/$record['harga_konsumen'])*100,0)."%";
        if ($disk['diskon']>0){ $diskon_persen = "<div class='stok-habis'>$diskon</div>"; }else{ $diskon_persen = ''; }
        if ($disk['diskon']>=1){ 
          $harga_konsumen =  "Rp ".rupiah($record['harga_konsumen']-$disk['diskon']);
          $harga_asli = "Rp ".rupiah($record['harga_konsumen']);
          $hargajadi = "<del style='color:#8a8a8a'>$harga_asli</del> $harga_konsumen/$record[satuan]";
        }else{
          $harga_konsumen =  "Rp ".rupiah($record['harga_konsumen']);
          $harga_asli = "";
          $hargajadi = $harga_konsumen."/".$record[satuan];
        }

            if ($this->session->level=='konsumen'){
                echo "<form id='frmAddCart' action='".base_url()."members/keranjang/$record[id_reseller]/$record[id_produk]' method='POST'>";
            }else{
                echo "<form id='frmAddCart' action='".base_url()."produk/keranjang/$record[id_reseller]/$record[id_produk]' method='POST'>";
            }
            
                if (($beli['beli']-$jual['jual'])>=1){
                    #echo "<tr><td style='font-weight:bold'>Tersedia</td> <td class='text-success'>".($beli['beli']-$jual['jual'])." stok barang</td></tr>";
                }else{
                    #echo "<tr><td style='font-weight:bold'>Stok</td> <td>Tidak Tersedia</td></tr>";
                }
?>
<section id="content">
<div class="md-margin"></div><!-- .space -->
        	<div class="container">
				<div class="row">
        			<div class="col-md-12">
        				<div class="row">
        				<div class="col-md-6 col-sm-12 col-xs-12 product-viewer clearfix">
                        <?php 
                        $ex = explode(';',$record['gambar']);
                        $hitungex = count($ex);
                        if (file_exists("asset/foto_produk/".$ex[0])) { 
                            if ($ex[0]==''){
                                $gambar = "<img alt='Product Big image' id='product-image' src='".base_url()."asset/foto_produk/no-produk.png'>";
                            }else{
                                $gambar = "<img alt='Product Big image' id='product-image' data-zoom-image='".base_url()."asset/foto_produk/".$ex[0]."' src='".base_url()."asset/foto_produk/".$ex[0]."'></a>";
                            }
                        }else{
                            $gambar = "<img alt='Product Big image' id='product-image' src='".base_url()."asset/foto_produk/no-produk.png'>";
                        }
                        ?>
						
        					<div id="product-image-carousel-container">
        						<ul id="product-carousel" class="celastislide-list">
                                <?php
                                
                                for($i=0; $i<$hitungex; $i++){
                                if (file_exists("asset/foto_produk/".$ex[$i])) { 
                                    if ($ex[$i]==''){
                                        $gambarr = "<img  src='".base_url()."asset/foto_produk/no-produk.png'>";
                                    }else{
                                        $gambarr = "<img src='".base_url()."asset/foto_produk/".$ex[$i]."'></a>";
                                        echo "<li><a data-rel='prettyPhoto[product]' href='".base_url()."asset/foto_produk/".$ex[$i]."' data-image='".base_url()."asset/foto_produk/".$ex[$i]."' data-zoom-image='".base_url()."asset/foto_produk/".$ex[$i]."' class='product-gallery-item'>$gambarr</a></li>";
                                    }
                                }else{
                                    $gambarr = "<img src='".base_url()."asset/foto_produk/no-produk.png'>";
                                }
                                }
                                ?>
									
        					    </ul><!-- End product-carousel -->
        					</div>
							<div id="product-image-container">
								<figure>
									<?php echo $gambar ?>
        						<!-- <img src="images/products/big-item1sss.jpg" data-zoom-image="images/products/big-item1.jpg" alt="Product SSS Big image" id="product-image"> -->
								<!-- <figcaption class="item-price-container">
										<span class="old-price">$160</span> 
										<span class="item-price"><%= number_to_currency(@diskon, unit: "Rp. ", separator: ",", delimiter: ".", precision:0) %>/><%= @satuan %></span>
									</figcaption>-->
        						</figure>
        					</div><!-- product-image-container -->        				 
        				</div><!-- End .col-md-6 -->

        				<div class="col-md-6 col-sm-12 col-xs-12 product">
                        <div class="lg-margin visible-sm visible-xs"></div><!-- Space -->
							<h1 class="product-name"><?php echo $record[nama_produk] ?></h1>
							
								<h4><span class="item-price"><?php echo $hargajadi ?></span></h4>
							
        					<div class="ratings-container">
								<div class="ratings separator">
									<div class="ratings-result" data-result="70"></div>
								</div><!-- End .ratings -->
								<span class="ratings-amount separator">
									3 Review(s)
								</span>
								<span class="separator">|</span>
								<a href="#review" class="rate-this">Add Your Review</a>
							</div><!-- End .rating-container -->
						<hr>
        				<ul class="product-list">
        					<li><span>Penjual:</span><?php echo "<a href='".base_url()."produk/produk_reseller/$rows[id_reseller]'>";echo $rows[nama_reseller]."</a>"; ?></li>
        					<li><span>Berat:</span><?php echo $record[berat]; ?> Gram</li>
							<li><span>Kategori:</span><?php echo "<a href='".base_url()."produk/kategori/$kat[kategori_seo]'>$kat[nama_kategori]</a>"; ?></li>
							<li><span>Jenis:</span><?php echo $record[tipe]; ?></li>
                            <?php if (($beli['beli']-$jual['jual'])>=1){
                                echo "<li><span>Stok:</span>".($beli['beli']-$jual['jual'])." </li>";
                            }else{
                                echo "<li><span>Stok:</span><i style='font-weight:bold'>Stok Habis</i></li>";
                            }
                            ?>
        				</ul>
        				<hr>
							<div class="product-add clearfix">
								<div class="custom-quantity-input">
									<input type="text" name="qty" value="1">
									<a href="#" onclick="return false;" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>
									<a href="#" onclick="return false;" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>
								</div>
								<button class="btn btn-custom-2"><i class="fa fa-shopping-cart"></i> Beli</button>
								<button class="btn btn-custom"><i class="fa fa-heart"></i></button>
							</div><!-- .product-add -->
						</form>
        					<div class="md-margin"></div><!-- Space -->
        					<div class="product-extra clearfix">
								<div class="product-extra-box-container clearfix">
									<!-- <div class="item-action-inner">
										<a href="#" class="icon-button icon-like">Favourite</a>
										<a href="#" class="icon-button icon-compare">Checkout</a>
									</div> End .item-action-inner -->
								</div>
								<div class="md-margin visible-xs"></div>
								<div class="share-button-group">
									<!-- AddThis Button BEGIN -->
									<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
									<a class="addthis_button_facebook"></a>
									<a class="addthis_button_twitter"></a>
									<a class="addthis_button_email"></a>
									<a class="addthis_button_print"></a>
									<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
									</div>
									<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
									<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b2197865ea0183"></script>
									<!-- AddThis Button END -->
								</div><!-- End .share-button-group -->
        					</div>
        				</div><!-- End .col-md-6 -->
        					
        					
        				</div><!-- End .row -->
        				
        				<div class="lg-margin2x"></div><!-- End .space -->
        				
        				<div class="row">
        					<div class="col-md-9 col-sm-12 col-xs-12">
        						
        						<div class="tab-container left product-detail-tab clearfix">
        								<ul class="nav-tabs">
										  <li class="active"><a href="#overview" data-toggle="tab">Rincian</a></li>
										  <li><a href="#description" data-toggle="tab">Description</a></li>
										  <li><a href="#review" data-toggle="tab">Review</a></li>
										  <li><a href="#additional" data-toggle="tab">Additional Info</a></li>
										  <li><a href="#video" data-toggle="tab">Video</a></li>
										</ul>
        								<div class="tab-content clearfix">
        									
        									<div class="tab-pane active" id="overview">
											<?php echo $record[keterangan] ?>
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="description">
												<p>The perfect mix of portability and performance in a slim 1" form factor:</p>
        										<ul class="product-details-list">
        											<li>3rd gen Intel® Core™ i7 quad core processor available;</li>
        											<li>Windows 8 Pro available;</li>
        											<li>13.3" and 15.5" screen sizes available;</li>
        											<li>Double your battery life with available sheet battery;</li>
        											<li>4th gen Intel® Core™ i7 processor available;</li>
        											<li>Full HD TRILUMINOS IPS touchscreen (1920 x 1080);</li>
        											<li>Super fast 512GB PCIe SSD available;</li>
        											<li>Ultra-light at just 2.34 lbs.</li>
        											<li>And more...</li>
        										</ul>
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="review">
        										
        										<p>Sed volutpat ac massa eget lacinia. Suspendisse non purus semper, tellus vel, tristique urna. </p>
        										<p>Cumque nihil facere itaque mollitia consectetur saepe cupiditate debitis fugiat temporibus soluta maxime doloremque alias enim officia aperiam at similique quae vel sapiente nulla molestiae tenetur deleniti architecto ratione accusantium.
        										</p>
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="additional">
        										<strong>Additional Informations</strong>
        										<p>Quae eum placeat reiciendis enim at dolorem eligendi?</p>
        										<hr>
        										<ul class="product-details-list">
        											<li>Lorem ipsum dolor sit quam</li>
        											<li>Consectetur adipisicing elit</li>
        											<li>Illum autem tempora officia</li>
        											<li>Amet  id odio architecto explicabo </li>
        											<li>Voluptatem  laborum veritatis</li>
        											<li>Quae laudantium iste libero</li>
        										</ul>
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="video">
        										<div class="video-container">
        											<strong>A Video about Product</strong>
        											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur adipisci esse.</p>
        											<hr>
        											<iframe width="560" height="315" src="//www.youtube.com/embed/Z0MNVFtyO30?rel=0"></iframe>
        											
        										</div><!-- End .video-container -->
        										
        									</div><!-- End .tab-pane -->
        								</div><!-- End .tab-content -->
        						</div><!-- End .tab-container -->
        						<div class="lg-margin visible-xs"></div>
        					</div><!-- End .col-md-9 -->
							<div class="lg-margin2x visible-sm visible-xs"></div><!-- Space -->
							
        					<div class="col-md-3 col-sm-12 col-xs-12 sidebar">
        						<div class="widget related">
        							<h3>Related</h3>
        							
        							<div class="related-slider flexslider sidebarslider">
        								<ul class="related-list clearfix">
        									<li>
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item1.jpg" alt="item1">
        											</figure>
        											<h5><a href="#">Jacket Suiting Blazer</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$40</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        										
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item2.jpg" alt="item2">
        											</figure>
        											<h5><a href="#">Gap Graphic Cuffed</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">18$</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        										
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item3.jpg" alt="item3">
        											</figure>
        											<h5><a href="#">Women's Lauren Dress</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$30</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        									</li>
        									<li>
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item4.jpg" alt="item4">
        											</figure>
        											<h5><a href="#">Swiss Mobile Phone</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="64"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$39</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        										
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item5.jpg" alt="item5">
        											</figure>
        											<h5><a href="#">Zwinzed HeadPhones</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="94"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$18.99</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        										
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item6.jpg" alt="item6">
        											</figure>
        											<h5><a href="#">Kless Man Suit</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="74"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$99</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        									</li>
        									<li>
        										
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item2.jpg" alt="item2">
        											</figure>
        											<h5><a href="#">Gap Graphic Cuffed</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$17</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        										
        										<div class="related-product clearfix">
        											<figure>
        												<img src="images/products/thumbnails/item4.jpg" alt="item4">
        											</figure>
        											<h5><a href="#">Women's Lauren Dress</a></h5>
        											<div class="ratings-container">
														<div class="ratings">
															<div class="ratings-result" data-result="84"></div>
														</div><!-- End .ratings -->
													</div><!-- End .rating-container -->
        											<div class="related-price">$30</div><!-- End .related-price -->
        										</div><!-- End .related-product -->
        									</li>
        								</ul>
        							</div><!-- End .related-slider -->
        						</div><!-- End .widget -->
        						
        					</div><!-- End .col-md-4 -->
        				</div><!-- End .row -->
						<div class="lg-margin2x"></div><!-- Space -->
						
        				<!-- Related -->
		
        			</div><!-- End .col-md-12 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->
        
        </section><!-- End #content -->