<?php echo"
<div class='shop-group'>
                                                <div class='shop-heading'>
                                                    <div class='shop-heading__flex'>
                                                        <div class='shop-heading__left'>
                                                            <div class='shl__text'>
                                                                <div class='shop-name-n-badges-wrapper'>
                                                                    <a class='shop-name' href='".base_url()."produk/produk_reseller/$rows[id_reseller]'>$rows[nama_reseller]</a>
                                                                </div>
                                                                <div class='shop-location' data-warehouse_id='793109'>$rows[nama_kota]
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='shop-body'>
                                                    <div class='shop-product'>
                                                        <div class='sb__inner-rows-wrapper'>
                                                            <div class='sb__inner-row sb__inner-row--top'>
                                                                <div class='sb__inner-row--top__flex'>
                                                                    <div class='sb__checkbox-n-img'>
                                                                        <div class='product-img-wrapper'>
                                                                            <div class='product-img-positioner'>
                                                                                <div class='css-1dzz2c4'>
                                                                                    <div class='product-img' style='background-image: url(".base_url()."asset/foto_produk/$foto_produk);'>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class='product-attrs-wrapper'>
                                                                        <div class='css-1dzz2c4'>
                                                                            <div class='product-name'>
                                                                                <a href='".base_url()."produk/detail/$row[id_produk]/$row[produk_seo]' class='product-name__link'>$row[nama_produk]</a>
                                                                            </div>
                                                                            <div class='price-wrapper'>
                                                                                <div class='final-price'>Harga. Rp ".rupiah($row['harga_jual']-$row['diskon'])." / $row[satuan] Total = Rp ".rupiah($sub_total)."</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='sb__inner-row sb__inner-row--lowest'>
                                                                <div class='gsu-displ-f gsu-justcon-sb'>
                                                                    <div class='sbirl__left gsu-fshrink-0 gsu-padr20px gsu-padt5px'>
                                                                            <div class='css-1a6sqok false'>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class='sbirl__right'>
                                                                        <div class='product-cta-wrapper gsu-displ-if'>
                                                                            <div>
                                                                                <div class='css-dkt74g btn-love--active'>
                                                                                    <div class=''>
                                                                                        <div class='fa fa-heart fa-lg' role='presentation'></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <a class='btn btn-danger btn-xs' title='Delete' href='".base_url()."members/keranjang_delete/$row[id_penjualan_detail]'>
                                                                                <div class='fa fa-trash fa-lg'>
                                                                                </div></a>
                                                                            </div>
                                                                            <div>
                                                                                <div class='css-1t2j5a4 false'>
                                                                                    <div class='css-11mguey-unf-quantity-editor e1ke628k0'>
                                                                                        Jumlah : 
                                                                                        <input type='text' max='999998' min='1' class='css-xybb0g-unf-quantity-editor__input e1ke628k2' value='$row[jumlah]'>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>";
                                                ?>