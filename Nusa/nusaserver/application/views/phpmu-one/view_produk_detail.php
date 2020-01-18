            <p class='sidebar-title'> &nbsp; <?php echo $judul; ?></p><hr>
            <?php 
              if (trim($row['gambar'])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $row['gambar']; }
              echo "<div class='col-sm-6'>
                        <center><img style='min-height:88px; width:90%' src='".base_url()."asset/foto_produk/$foto_produk'></center>
                    </div>
                    <div class='col-sm-6'>
                          <h2>$row[nama_produk]</h2>";
                          $harga = explode(';', $row[harga_konsumen]);
                          if ($row[id_produk] == '17'){
                            if ($kons[ph]=='0'){
                              $hargafix = $harga[1];
                              echo "Harga Pertama Pembelian : <span style='color:green; font-size:20px'><del>Rp ".rupiah($harga[0])."</del> Rp ".rupiah($harga[1])."</span><br>";
                            }else{
                              $hargafix = $harga[0];
                              echo "Harga : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[0])."</span><br>";
                            }
                            echo "Harga 1 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[0])."</span><br>
                            Harga 6 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[2])."</span> ( Hemat ".rupiah((6*$harga[0])-$harga[2])." )<br>
                            Harga 12 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[3])."</span> ( Hemat ".rupiah((12*$harga[0])-$harga[3])." )<br>";
                          }elseif($row[id_produk] == '18'){
                            if ($kons[pt]=='0'){
                              echo "Harga Pertama Pembelian : <span style='color:green; font-size:20px'><del>Rp ".rupiah($harga[0])."</del> Rp ".rupiah($harga[1])."</span><br>";
                            }else{
                              echo "Harga : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[0])."</span><br>";
                            }
                            echo "Harga 1 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[0])."</span><br>
                            Harga 6 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[2])."</span> ( Hemat ".rupiah((6*$harga[0])-$harga[2])." )<br>
                            Harga 12 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[3])."</span> ( Hemat ".rupiah((12*$harga[0])-$harga[3])." )<br>";
                          }elseif($row[id_produk] == '19'){
                            if ($kons[pb]=='0'){
                              echo "Harga Pertama Pembelian : <span style='color:green; font-size:20px'><del>Rp ".rupiah($harga[0])."</del> Rp ".rupiah($harga[1])."</span><br>";
                            }else{
                              echo "Harga : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[0])."</span><br>";
                            }
                            echo "Harga 1 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[0])."</span><br>
                            Harga 6 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[2])."</span> ( Hemat ".rupiah((6*$harga[0])-$harga[2])." )<br>
                            Harga 12 Bulan : <span style='color:green; font-size:20px'>Rp ".rupiah($harga[3])."</span> ( Hemat ".rupiah((12*$harga[0])-$harga[3])." )<br>";
                          }
                          
                          echo "<hr>
                          <form action='".base_url()."produk/keranjang' method='POST'>
                          <input type='hidden' name='id_produk' value='$row[id_produk]'>
                          <select name='jumlah' class='form-control' style='width:250px; diplay:inline-block'>
                            <option value='' selected>--- Pilih Lama Pembelian ---</option>
                            <option value='1;".$hargafix."'>1 Bulan</option>
                            <option value='6'>6 Bulan</option>
                            <option value='12'>12 Bulan</option>
                          </select><br>
                          <!--<input class='form-control ' type='text' name='jumlah' value='1' style='width:150px; diplay:inline-block'><br> -->
                          <input class='btn btn-success btn-sm' type='submit' value='Beli Sekarang'>
                          </form>
                          <hr>

                          $row[keterangan]<br>
                          <div class='addthis_toolbox addthis_default_style'>
                              <a class='addthis_button_preferred_1'></a>
                              <a class='addthis_button_preferred_2'></a>
                              <a class='addthis_button_preferred_3'></a>
                              <a class='addthis_button_preferred_4'></a>
                              <a class='addthis_button_compact'></a>
                              <a class='addthis_counter addthis_bubble_style'></a>
                          </div>
                          <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8aab4674f1896a'></script>
                    </div>
                    <div style='clear:both'><br></div>";
?>
<div class="yotpo yotpo-main-widget"
data-product-id="SKU/Product_ID"
data-price="Product Price"
data-currency="Price Currency"
data-name="Product Title"
data-url="The url to the page where the product is (url escaped)"
data-image-url="The product image url. Url escaped"
data-description="Product description">
</div>
