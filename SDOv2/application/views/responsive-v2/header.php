<?php 
$record = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','ASC');  
$total = $this->db->query("SELECT COUNT(*) as cart, sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$this->session->idp."'")->row_array();

?>
<header id="header" class="header6">
            <div id="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header-top-left">
                                <ul id="top-links" class="clearfix">
                                    <p class="header-text">Welcome to PekanRaya!</p>
                                </ul>
                            </div><!-- End .header-top-left -->
                            <div class="header-top-right">
                                <div class="header-text-container pull-right">
                                <?php if($this->session->id_konsumen==''){
                                    echo "<p class='header-link'><a href='".base_url()."auth/login'>Masuk</a>&nbsp;atau&nbsp;<a href='".base_url()."auth/register'>Buat Akun</a></p>";
                                    //echo "<p class='header-link'><a href='#' id='popupLogin'>Masuk</a>&nbsp;atau&nbsp;<a href='".base_url()."auth/register'>Buat Akun</a></p>";
                                }else{
                                    $nama = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
                                    echo "<p class='header-link'>Selamat Datang " .$nama['username']. " | <a href='#' id='btnLogout'>Logout</a></p>";
                                }
                                ?>
                                </div><!-- End .pull-right -->
                            </div><!-- End .header-top-right -->
                        </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End #header-top -->
            
            <div id="inner-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12 logo-container">
                            <h1 class="logo clearfix">
                                <span>Responsive eCommerce Template</span>
                                <?php 
                                    $iden = $this->model_utama->view('identitas')->row_array();
                                    $logo = $this->model_utama->view_ordering_limit('logo','id_logo','DESC',0,1);
                                    foreach ($logo->result_array() as $row) {
                                    echo "<a href='".base_url()."'><img style='width: 200px; height: 54px;' src='".base_url()."asset/logo/$row[gambar]'/></a>";
                                    }
                                ?>
                            </h1>
                        </div><!-- End .col-md-3 -->
                        <div class="col-md-9 col-sm-9 col-xs-12 header-inner-right">
                            <div class="header-inner-right-wrapper clearfix">
                                <div id='reloading'></div>
                                <div id='reloadcontent'>
                                <div class="dropdown-cart-menu-container pull-right">
                                    <div class="btn-group dropdown-cart">
                                    <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                        <span class="cart-menu-icon"></span>
                                        <?php echo $total['cart'] ?> item(s) <span class="drop-price">- <?php echo "Rp. ".rupiah($total['total']) ?></span>
                                        <?php echo "<input type='hidden' id='totbelanja' value='".$total['cart']."' \>"; ?>
                                    </button>
                                    
                                        <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                            <p class="dropdown-cart-description">Terakhir Item Ditambahkan</p>
                                            <ul class="dropdown-cart-product-list">
                                               
                                            <?php
          $no = 1;
          foreach ($record as $row){
          $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
          $ex = explode(';', $row['gambar']);
          if (trim($ex[0])==''){ $foto_produk = 'no-produk.png'; }else{ $foto_produk = $ex[0]; }
          echo "<li class='item clearfix'>
                <input type='hidden' id='idpen$no' value='".$row[id_penjualan_detail]."' \>
                <a id='hapuscart$no' href='#' title='Hapus item' class='delete-item'><i class='fa fa-times'></i></a>
                    <figure>
                        <img src='".base_url()."asset/foto_produk/$foto_produk'>
                    </figure>
                    <div class='dropdown-cart-details'>
                        <p class='item-name'>
                            <a href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]'>$row[nama_produk] ($row[jumlah])</a>
                        </p>
                        <p>
                            
                            <span class='item-price'>Rp. ".rupiah($sub_total)."</span>
                        </p>
                    </div>
                </li>";
            $no++;
          }
          $total = $this->db->query("SELECT COUNT(*) as cart, sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."'")->row_array();
        
?> 
                                                <!-- <li class="item clearfix">
                                                <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>
                                                <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
                                                    <figure>
                                                        <a href="product.html"><img src="images/products/thumbnails/item12.jpg" alt="phone 4"></a>
                                                    </figure>
                                                    <div class="dropdown-cart-details">
                                                        <p class="item-name">
                                                        <a href="product.html">Cam Optia AF Webcam </a>
                                                        </p>
                                                        <p>
                                                            1x
                                                            <span class="item-price">$499</span>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="item clearfix">
                                                <a href="#" title="Delete item" class="delete-item"><i class="fa fa-times"></i></a>
                                                <a href="#" title="Edit item" class="edit-item"><i class="fa fa-pencil"></i></a>
                                                    <figure>
                                                        <a href="product.html"><img src="images/products/thumbnails/item13.jpg" alt="phone 2"></a>
                                                    </figure>
                                                    <div class="dropdown-cart-details">
                                                        <p class="item-name">
                                                            <a href="product.html">Iphone Case Cover Original</a>
                                                        </p>
                                                        <p>
                                                            1x
                                                            <span class="item-price">$499<span class="sub-price">.99</span></span>
                                                        </p>
                                                    </div>
                                                </li> -->
                                            </ul>
                                            
                                            <ul class="dropdown-cart-total">
                                                <li><span class="dropdown-cart-total-title">Shipping:</span>0</li>
                                                <?php $total= $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$this->session->idp."'")->row_array(); ?>
                                                <li><span class="dropdown-cart-total-title">Total:</span><?php echo "Rp. ".rupiah($total['total']) ?></li>
                                            </ul><!-- .dropdown-cart-total -->
                                            <div class="dropdown-cart-action">
                                                <p><a href='<?php echo base_url(); ?>members/keranjang' class="btn btn-custom-2 btn-block">Keranjang</a></p>
                                                <p><a href='<?php echo base_url(); ?>members/checkouts' class="btn btn-custom btn-block">Checkout</a></p>
                                            </div><!-- End .dropdown-cart-action -->
                                            
                                        </div><!-- End .dropdown-cart -->
                                    </div><!-- End .btn-group -->
                                </div><!-- End .dropdown-cart-menu-container -->
                                </div><!-- end reloading -->
                                <div id="quick-access">
                                <?php echo form_open('produk/index') ?>
                                    <div class="form-group">
		                                <input autocomplete='off' name='kata' class='form-control' placeholder='Cari produk atau toko' type='text' value=''/>
		                                <input name='max-results' type='hidden' value='0'/>
                                    </div>
		                            <button type="submit" id="quick-search" class='btn btn-custom'><i></i></button>
	                            </form>
                                
                                </div><!-- End #quick-access -->

                                <div class="header-box contact-infos pull-right">
                                    <ul>
                                        <li><span class="header-box-icon header-box-icon-email"></span><a href="mailto:mbahcip00@gmail.com">mbahcip00@gmail.com</a></li>
                                        <li><span class="header-box-icon header-box-icon-email"></span><a href="mailto:ncip48@gmail.com">ncip48@gmail.com</a></li>
                                    </ul>
                                </div><!-- End .contact-infos -->
                                
                                <div class="header-box contact-phones pull-right clearfix">
                                    <span class="header-box-icon header-box-icon-earphones"></span>
                                    <ul class="pull-left">
                                        <li>+(62) 81335241314</li>
                                        <li>+(62) 89615182622</li>
                                    </ul>
                                </div><!-- End .contact-phones -->

                            </div><!-- End .header-inner-right-wrapper -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
                
                <div id="main-nav-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 clearfix">
                                
                                <nav id="main-nav">
                                    <div id="responsive-nav">
                                        <div id="responsive-nav-button">
                                            Menu <span id="responsive-nav-button-icon"></span>
                                        </div><!-- responsive-nav-button -->
                                    </div>
                                    <div class="menu-table">
                                        <ul class="menu clearfix">
                                        <li>
                                            <a class="active" href="<?php echo base_url(); ?>">HOME</a>
                                        </li>
                                        <li class="mega-menu-container">
                                            <a href="<?php echo base_url() ?>produk">Produk</a>
                                        </li>
                                        <li>
                                            <a href="#">PAGES</a>
                                            <ul>
                                                <li><a href="#">Headers</a>
                                                    <ul>
                                                        <li><a href="header1.html">Header Version 1</a></li>
                                                        <li><a href="header2.html">Header Version 2</a></li>
                                                        <li><a href="header3.html">Header Version 3</a></li>
                                                        <li><a href="header4.html">Header Version 4</a></li>
                                                        <li><a href="header5.html">Header Version 5</a></li>
                                                        <li><a href="header6.html">Header Version 6</a></li>
                                                        <li><a href="header7.html">Header Version 7</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Footers</a>
                                                    <ul>
                                                        <li><a href="footer1.html">Footer Version 1</a></li>
                                                        <li><a href="footer2.html">Footer Version 2</a></li>
                                                        <li><a href="footer3.html">Footer Version 3</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="product.html">Product</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="category.html">Category</a>
                                                    <ul>
                                                        <li><a href="category-list.html">Category list</a></li>
                                                        <li><a href="category.html">Category Banner 1</a></li>
                                                        <li><a href="category-banner-2.html">Category Banner 2</a></li>
                                                        <li><a href="category-banner-3.html">Category Banner 3</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="blog.html">Blog</a>
                                                    <ul>
                                                        <li><a href="blog.html">Right Sidebar</a></li>
                                                        <li><a href="blog-sidebar-left.html">Left Sidebar</a></li>
                                                        <li><a href="blog-sidebar-both.html">Both Sidebar</a></li>
                                                        <li><a href="single.html">Blog Post</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="aboutus.html">About Us</a></li>
                                                <li><a href="register-account.html">Register Account</a></li>
                                                <li><a href="compare-products.html">Compare Products</a></li>
                                                <li><a href="login.html">Login</a></li>
                                                <li><a href="404.html">404 Page</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Portfolio</a>
                                            <ul>
                                                <li><a href="#">Classic</a>
                                                    <ul>
                                                        <li><a href="portfolio-2.html">Two Columns</a></li>
                                                        <li><a href="portfolio-3.html">Three Columns</a></li>
                                                        <li><a href="portfolio-4.html">Four Columns</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Masonry</a>
                                                    <ul>
                                                        <li><a href="portfolio-masonry-2.html">Two Columns</a></li>
                                                        <li><a href="portfolio-masonry-3.html">Three Columns</a></li>
                                                        <li><a href="portfolio-masonry-4.html">Four Columns</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Portfolio Posts</a>
                                                    <ul>
                                                        <li><a href="single-portfolio.html">Image Post</a></li>
                                                        <li><a href="single-portfolio-gallery.html">Gallery Post</a></li>
                                                        <li><a href="single-portfolio-video.html">Video Post</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Elements</a>
                                            <ul>
                                                <li><a href="elements/tabs.html">Tabs</a></li>
                                                <li><a href="elements/titles.html">Titles</a></li>
                                                <li><a href="elements/typography.html">Typography</a></li>
                                                <li><a href="elements/collapses.html">collapses</a></li>
                                                <li><a href="elements/animations.html">animations</a></li>
                                                <li><a href="elements/grids.html">Grid System</a></li>
                                                <li><a href="elements/alerts.html">Alert Boxes</a></li>
                                                <li><a href="elements/buttons.html">Buttons</a></li>
                                                <li><a href="elements/medias.html">Media</a></li>
                                                <li><a href="elements/forms.html">Forms</a></li>
                                                <li><a href="elements/icons.html">Icons</a></li>
                                                <li><a href="elements/lists.html">Lists</a></li>
                                                <li><a href="elements/more.html">More</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                        <li><a href='<?php echo base_url(); ?>members/profile'>Akun Saya</a></li>
                                        <li><a href="#">News</a></li>
                                        <li><a href="http://themeforest.net/item/venedor-premium-bootstrap-ecommerce-html5-template/7426521?ref=SW-THEMES" target="_blank">Buy Venedor</a></li>
                                    </ul>
                                    </div>
                                    
                                </nav>
                                
                            </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
                    
                </div><!-- End #nav -->
            </div><!-- End #inner-header -->
        </header><!-- End #header -->