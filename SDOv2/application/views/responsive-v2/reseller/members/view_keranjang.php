<section id="content">
        	<div id="breadcrumb-container">
        		<div class="container">
					<ul class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">Shopping Cart</li>
					</ul>
        		</div>
        	</div>
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
						<header class="content-title">
							<h1 class="title">Keranjang Belanja</h1>
						</header>
        				<div class="xs-margin"></div><!-- space -->
        				<div class="row">
        					
        					<div class="col-md-12 table-responsive">
								
        						<table class="table cart-table">
        						<thead>
        							<tr>
										<th class="table-title">Nama Produk</th>
										<th class="table-title">Harga Satuan</th>
										<th class="table-title">Jumlah</th>
										<th class="table-title">SubTotal</th>
        							</tr>
        						</thead>
								<tbody>
                                <?php 
                                    $no = 1;
                                    foreach ($record as $row){
                                    $ex = explode(';', $row['gambar']);
                                    if (trim($ex[0])==''){ $foto_produk = 'no-produk.png'; }else{ $foto_produk = $ex[0]; }

                                    $alamat_customer = $cust['kota_id'];
                                    $kab_customer = $cust['kab_id'];

                                    $ke3 = file_get_contents("http://api.shipping.esoftplay.com/subdistrict/$kab_customer/$alamat_customer");
                                    $ke4 = json_decode($ke3, true);

                                    $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
                                    /* echo "<tr><td>$no</td>
                                                <td width='70px'><img style='border:1px solid #cecece; width:60px' src='".base_url()."asset/foto_produk/$foto_produk'></td>
                                                <td><a style='color:#ab0534' href='".base_url()."produk/detail/$row[produk_seo]'><b>$row[nama_produk]</b></a>
                                                    <br>Qty. <b>$row[jumlah]</b>, Harga. Rp ".rupiah($row['harga_jual']-$row['diskon'])." / $row[satuan], 
                                                    <br>Berat. <b>".($row['berat']*$row['jumlah'])." Gram</b></td>
                                                <td>Rp ".rupiah($sub_total)."</td>
                                                <td width='30px'><a class='btn btn-danger btn-xs' title='Delete' href='".base_url()."members/keranjang_delete/$row[id_penjualan_detail]'><span class='glyphicon glyphicon-remove'></span></a></td>
                                            </tr>"; */
                                        echo "<tr>
										<td class='item-name-col'>
                                            <figure>
                                                <a href='".base_url()."produk/detail/$row[produk_seo]'><img src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                            </figure>
                                            <header class='item-name'><a href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]'>$row[nama_produk]</a></header>
                                            <ul>
                                                <li>Penjual: <a href='".base_url()."members/produk_reseller/$rows[id_reseller]'>$rows[nama_reseller]</a></li>
                                                <li>Lokasi: ".$ke4['result']['subdistrict_name']."</li>
                                                <li>Berat: ".($row['berat']*$row['jumlah'])." Gram</li>
                                            </ul>
                                        </td>
                                        <td class='item-price-col'><span class='item-price-special'>Rp ".rupiah($row['harga_jual']-$row['diskon'])."</span></td>
                                        <td>$row[jumlah]</td>
                                        <td class='item-total-col'><span class='item-price-special'>Rp ".rupiah($sub_total)."</span>
                                        <a href='".base_url()."members/keranjang_delete/$row[id_penjualan_detail]' class='close-button'></a>
                                        </td>
                                        </tr>";
                                        $no++;
                                    }
                                    $total = $this->db->query("SELECT COUNT(*) as jumlaah, sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$this->session->idp."'")->row_array();
                                ?>
                                </tbody>
                                </table>
        					</div>
        					
        				</div><!-- End .row -->
        				<div class="lg-margin"></div><!-- End .space -->
        				
        				<div class="row">
        					<div class="col-md-8 col-sm-12 col-xs-12 lg-margin">
        						
        						<div class="tab-container left clearfix">
        								<ul class="nav-tabs">
										  <li class="active"><a href="#shipping" data-toggle="tab">Kurir</a></li>
										  <li><a href="#discount" data-toggle="tab">Discount Code</a></li>
										  <li><a href="#gift" data-toggle="tab">Gift voucher </a></li>
										  
										</ul>
        								<div class="tab-content clearfix">
        									<div class="tab-pane active" id="shipping">

                                            <?php 
                                                

                                                $alamat_penjual = $rows['kota_id'];
                                                $kab_penjual = $rows['kab_id'];

												if ($total['total_berat'] < 1000) {
													$totbrt = '1';
												}else{
													$totbrt = round($total['total_berat']/1000);
												}

                                                $data = file_get_contents("http://api.shipping.esoftplay.com/domesticCost/$alamat_customer/$alamat_penjual/$totbrt/");
                                                $ongkir = json_decode($data, true);

                                                

                                                $ke = file_get_contents("http://api.shipping.esoftplay.com/subdistrict/$kab_penjual/$alamat_penjual");
												$ke2 = json_decode($ke, true);

												
												echo $error_reseller; 
												if ($this->session->idp == ''){
													echo "<center style='padding:10%'><i class='text-danger'>Maaf, Keranjang belanja anda saat ini masih kosong,...</i><br>
															<a class='btn btn-warning btn-sm' href='".base_url()."members/reseller'>Klik Disini Untuk mulai Belanja!</a></center>";
												}else{

                                            ?>
        										
                                                    <p class="shipping-desc">Pengiriman <?php echo $ke4['result']['subdistrict_name'] ?> Ke <?php echo $ke2['result']['subdistrict_name'] ?></p>
        											<p class="shipping-desc">Pilih Kurir dibawah ini.</p>
													<div class="form-group">
														<label for="select-country" class="control-label">Kurir</label>
														<div class="input-container normal-selectbox">
                                                            <select id="selectkurir" name="selectkurir" style='width=390px;'>
                                                                <option value='none' style='width=390px;' selected > --- Pilih Kurir --- </option>
                                                            <?php foreach($ongkir["result"] as $result){
                                                                    foreach($result["costs"] as $hasil){
                                                                        foreach($hasil["cost"] as $f){
                                                                            echo "<option style='width=390px;' value='".$f['value'].";".$result['name'].";".$hasil['service'].";".$hasil['description']."'>".strtoupper($result['code'])." ". $hasil['service']." ($f[etd] Hari)</option>";
                                                                        }  
                                                                    }                                                                          
                                                            } ?>
                                                            </select>
                                                        </div><!-- End .select-container -->
													</div><!-- End .form-group -->
													<div class="xss-margin"></div>
													<div class="form-group">
                                                        <label for="select-state" class="control-label">Nama Kurir</label>
                                                        <div class="input-container">
                                                            <div id="namakurir">-</div>
                                                        </div>
                                                    </div><!-- End .form-group -->
        										  <div class="xss-margin"></div>
        										<div class="form-group">
													<label for="select-country" class="control-label"  >Service</label>
													<div class="input-container">
                                                        <div id="services">-</div>
                                                    </div>
												</div><!-- End .form-group -->
												
												
												
        										
        										
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="discount">
        										<p>Enter your discount coupon code here.</p>
        										
        											<div class="input-group">
														<input type="text" required class="form-control" placeholder="Coupon code">
														
													</div><!-- End .input-group -->	
        										<input type="submit" class="btn btn-custom-2" value="APPLY COUPON">
        										
        									</div><!-- End .tab-pane -->
        									
        									<div class="tab-pane" id="gift">
        										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi dignissimos nostrum debitis optio molestiae in quam dicta labore obcaecati ullam necessitatibus animi deleniti minima dolor suscipit nobis est excepturi inventore.</p>
        									</div><!-- End .tab-pane -->
        									
        								</div><!-- End .tab-content -->
        						</div><!-- End .tab-container -->
        						
        					</div><!-- End .col-md-8 -->

        					<div class="col-md-4 col-sm-12 col-xs-12">
        						
        						<table class="table total-table">
        							<tbody>
        								<tr>
        									<td class="total-table-title">Subtotal:</td>
        									<td><div id='totbayar' value="<?php echo $total['total'] ?>"><?php echo 'Rp '.rupiah($total[total]) ?></div></td>
        								</tr>
                                        <tr>
        									<td class="total-table-title">Total Berat</td>
                                            <td><?php   if($total['total_berat'] > 1000){
                                                            echo round($total['total_berat']/1000)." Kg";
                                                            echo "<div id='totalberat' value='".($total['total_berat']/1000)."'></div>";
                                                        }else{
                                                            echo $total['total_berat']." gram";
                                                            echo "<div id='totalberat' value='".$total['total_berat']."'></div>";
                                                        }
                                            ?></td>
        								</tr>
        								<tr>
        									<td class="total-table-title">Ongkir:</td>
        									<td><div id='ongkir2'>0 </div></td>
        								</tr>
        							</tbody>
        							<tfoot>
        								<tr>
											<td>Total:</td>
											<td><div id='totalbayar'>0</div></td>
        								</tr>
        							</tfoot>
        						</table>
        						<div class="md-margin"></div><!-- End .space -->
        						<a href='<?php echo base_url()?>members/produk_reseller/<?php echo $rows[id_reseller] ?>' class="btn btn-custom-2">Lanjutkan Belanja</a>
        						<form action='<?php echo base_url() ?>members/selesai_belanja' method='POST' style='margin-top:0px;'>
									<input type='hidden' name="ongkir" id="ongkiir" \>
									<input type='hidden' name="service" id="servicees" \>
									<input type='hidden' name="kurir" id="kurirr" \>
									<button type='submit' name='submit' class="btn btn-custom">BAYAR</button>
								</form>
        					</div><!-- End .col-md-4 -->
        				</div><!-- End .row -->
        				<div class="md-margin2x"></div><!-- Space -->
        			</div><!-- End .col-md-12 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->
        <?php } ?>
        </section><!-- End #content -->