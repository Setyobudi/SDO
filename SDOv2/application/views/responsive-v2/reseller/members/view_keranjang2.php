<?php $kodevoucher = $this->uri->segment(3); 
$voucher=$this->db->query("SELECT * FROM rb_voucher where code='$kodevoucher'")->row_array();
$x=$this->db->query("SELECT * FROM voucher_user a LEFT JOIN rb_voucher b ON a.id_voucher=b.id_voucher where a.id_konsumen='".$this->session->id_konsumen."' AND b.code='$kodevoucher'")->row_array();
#echo "tanggal berlaku ".$x[berlaku];
#echo "<br>";
#echo "tanggal sekarang ".date('Y-m-d');

#$bayar = "<div id='totalbayar'>";

#echo $totalbayar;


?>
<div class="corplat-mother-container">
    <div id="treats-root">
        <div>
            <div></div>
            <div>
                <div>
                    <div class="css-w91ivc">
                        <div class="css-12i6wp8 corplat-mother-container">
                            <div class="corplat-mother-container-left">
                                <div class="corplat-mother-container-left__content" style="min-height: 321px;">
                                    <div class="css-6x7r8f">
                                        <div class="css-1dzz2c4">
                                            <div class="gsu-margt-20px"></div>
                                            <div class="corplat-sidebar-top-pitcher"></div>
                                            <div class="header-tickers-wrapper"></div>
                                            <div class="carts-group-valid">
                                              <div class="checkboxes-main-controller-bar-wrapper">
                                                <div class="checkboxes-main-controller-bar">
                                                  <div class="cmcb__left">
                                                    <div class="cmcbl__text" role="presentation">
                                                      <span>Detail Pesanan Anda</span>
                                                    </div>
                                                  </div>
                                                  <div class="cmcb__right">
                                                    <div class="cmcbr__cta-delete" role="presentation">
                                                      <span><?php echo "<a class='btn btn-danger btn-sm' href='".base_url()."members/batalkan_transaksi' onclick=\"return confirm('Apa anda yakin untuk Batalkan Transaksi ini?')\">Batalkan Transaksi</a></span>"; ?>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                                <div>
<?php 
echo "<form action='".base_url()."members/selesai_belanja' method='POST' style='margin-top:0px;'>";
  echo $error_reseller; 
  if ($this->session->idp == ''){
    echo "<center style='padding:10%'><i class='text-danger'>Maaf, Keranjang belanja anda saat ini masih kosong,...</i><br>
            <a class='btn btn-warning btn-sm' href='".base_url()."members/reseller'>Klik Disini Untuk mulai Belanja!</a></center>";
  }else{
?>

      <?php 
        #echo "<a class='btn btn-success btn-sm' href='".base_url()."members/produk_reseller/$rows[id_reseller]'>Lanjut Belanja</a>
             # <a class='btn btn-danger btn-sm' href='".base_url()."members/batalkan_transaksi' onclick=\"return confirm('Apa anda yakin untuk Batalkan Transaksi ini?')\">Batalkan Transaksi</a>"; 
      ?>
      <!-- <div style="clear:both"><br></div>
      <table class="table table-striped table-condensed">
          <tbody> -->
        <?php 
          $no = 1;
          foreach ($record as $row){
          $ex = explode(';', $row['gambar']);
          if (trim($ex[0])==''){ $foto_produk = 'no-produk.png'; }else{ $foto_produk = $ex[0]; }

          $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
          /* echo "<tr><td>$no</td>
                    <td width='70px'><img style='border:1px solid #cecece; width:60px' src='".base_url()."asset/foto_produk/$foto_produk'></td>
                    <td><a style='color:#ab0534' href='".base_url()."produk/detail/$row[produk_seo]'><b>$row[nama_produk]</b></a>
                        <br>Qty. <b>$row[jumlah]</b>, Harga. Rp ".rupiah($row['harga_jual']-$row['diskon'])." / $row[satuan], 
                        <br>Berat. <b>".($row['berat']*$row['jumlah'])." Gram</b></td>
                    <td>Rp ".rupiah($sub_total)."</td>
                    <td width='30px'><a class='btn btn-danger btn-xs' title='Delete' href='".base_url()."members/keranjang_delete/$row[id_penjualan_detail]'><span class='glyphicon glyphicon-remove'></span></a></td>
                </tr>"; */
            include 'y.php';
            $no++;
          }
          $bayar = "<div id='totalbayar'>";
          
          $total = $this->db->query("SELECT COUNT(*) as jumlaah, sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$this->session->idp."'")->row_array();
          
          if($x[code]==''){
            $y="Tidak memilih voucher";
            $z="Tidak memilih voucher";
            $diskvouc=$total[total];
            $a='0';
          }else{
            if($x[berlaku]<=date('Y-m-d')){
              $y="Kadaluarsa";
              $z=$y;
              $diskvouc=$total[total];
              $a='0';
            }else{
              if($total[total]>=$x[min_trx]){
                if($x[diskon]==0){
                  $y=$x[nama_voucher];
                  $z='Rp '.rupiah($x[max]);
                  $diskvouc=$total[total]-$z;
                  $a='0';
                }else{
                  $y=$x[nama_voucher];
                  $z=($x[diskon]/100) * $total[total];
                  if($z>=$x[max]){
                    $a= $x[max];
                    $diskvouc = $total[total]-$a;
                  }else{
                    $diskvouc = $total[total]-$z;
                    $a=$z;
                  } 
                }
              }else{
                $diskvouc=$total[total];
                $z='Tidak Memenuhi Min Belanja';
                $a='0';
              }
              #echo $diskvouc;
            }
          }

          /* echo "<tr class='success'>
                  <td colspan='3'><b>Total Berat</b></td>
                  <td><b>$total[total_berat] Gram</b></td>
                  <td></td>
                </tr>
                <tr class='success'>
                  <td colspan='3'><b>Voucher</b></td>
                  <td><b>$y</b></td>
                  <td></td>
                </tr>
        </tbody>
      </table>
      <div class='col-md-4 pull-right'>
        <center>Total Bayar <br><h2><s>$total[total]</s></h2></h2>
        </center>
        <center>
        </center>
    </div>"; */
        
      $ket = $this->db->query("SELECT * FROM rb_keterangan where id_reseller='".$rows['id_reseller']."'")->row_array();
      $diskon_total = '0';

?>

</div>
                                        </div>
                                        <div class="corplat-sidebar-bottom-pitcher"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="corplat-mother-container-right">
                            <div class="css-c7ff21">
                                <div id="corplat-sidebar-positioner" class="summary-positioner" style="left: 0px; top: 20px; position: absolute; height: 0px; bottom: auto; right: auto;">
                                    <div class="css-1dzz2c4">
                                        <div class="summary-wrapper summary-position-initiated">
                                            <div class="fixed-wrapper">
                                                <section class="corplat-sidebar-card css-vuebij-unf-card eyk31ek0">
                                                    <div>
                                                        <div class="sidebar-heading-text">Ringkasan Belanja <?php echo $this->session->idp ?></div>
                                                        <!--<div class="summary-details-n-insc-wrapper">
                                                            <div class="summary-details-wrapper">
                                                                <div class="summary-detail">
                                                                    <div class="summary-detail__label">Total Harga</div>
                                                                    <div class="summary-detail__value"><?php echo 'Rp '.rupiah($total[total]) ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="summary-details-wrapper">
                                                                <div class="summary-detail">
                                                                    <div class="summary-detail__label">Total Harga</div>
                                                                    <div class="summary-detail__value"><div id='totalbayar'></div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <div class="summary-shops-sum-potential-cashback-row">
                                                            <div class="summary-shops-sum-potential-cashback-box">
                                                                <div class="summary-shops-sum-potential-cashback__label">Total Harga</div>
                                                                <div class="summary-shops-sum-potential-cashback__value"><?php echo 'Rp '.rupiah($total[total]) ?></div>
                                                            </div>
                                                            <div class="summary-shops-sum-potential-cashback-box">
                                                                <div class="summary-shops-sum-potential-cashback__label">Voucher</div>
                                                                <div class="summary-shops-sum-potential-cashback__value"><?php echo $z; ?></div>
                                                            </div>
                                                            <div class="summary-shops-sum-potential-cashback-box">
                                                                <div class="summary-shops-sum-potential-cashback__label">TOTAL</div>
                                                                <div class="summary-shops-sum-potential-cashback__value" id='totalbayar'></div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="summary-main-btns-wrapper">
                                                            <div class="summary-main-btn">
                                                                <div role="presentation">
                                                                <button type='submit' name='submit' id='oksimpan' class='css-t0f30v-unf-btn e1ggruw00' style='display: none'>
                                                                        <span>Beli Sekarang <?php echo '('.$total[jumlaah].')' ?></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" name="total" id="total" value="<?php echo $diskvouc; ?>"/>
<input type="hidden" name="diskvoucher" value="<?php echo $a; ?>"/>
<input type="hidden" name="ongkir" id="ongkir" value="0"/>
<input type="hidden" name="berat" value="<?php echo $total['total_berat']; ?>"/>
<input type="hidden" name="diskonnilai" id="diskonnilai" value="<?php echo $diskon_total; ?>"/>




<div class="form-group">
    <label class="col-sm-2 control-label" for="">Pilih Kurir</label>
    <div class="col-md-10">
    <div class="dropdown2">
                    <button class="dropbtn2">Kurir</button>
                    <div class="dropdown2-content">
        <?php       
        $kurir=array('jne','pos','tiki');
        foreach($kurir as $rkurir){
            ?>          
                <label class="radio-inline">
                <input type="radio" name="kurir" class="kurir" value="<?php echo $rkurir; ?>"/> <?php echo strtoupper($rkurir); ?>
                </label>

                
                        <a name="kurir" class="kurir" value="<?php echo $rkurir; ?>"/> <?php echo strtoupper($rkurir); ?> </a>
                    
            <?php
        }
        ?>
        </div>
                </div>
        <label class="radio-inline"><input type="radio" name="kurir" class="kurir" value="cod"/> COD / Kendaraan Pribadi</label>

    </div>
</div>
<div id="kuririnfo" style="display: none;">
    <div class="form-group">
        <div class="col-md-12">
            <div class='alert alert-info' style='padding:5px; border-radius:0px; margin-bottom:0px'>Service</div>
            <p class="form-control-static" id="kurirserviceinfo"></p>
        </div>
    </div>
</div>

<!-- <button type='submit' name='submit' id='oksimpan' class='btn btn-success btn-flat btn-sm' style='display: none'>Lakukan Pembayaran</button>-->
<?php
#  $this->db->query("UPDATE `voucher_user` SET `use`='Y' WHERE id_konsumen='".$this->session->id_konsumen."' AND id_voucher=$x[id_voucher]");
?>

<?php
echo form_close();
?>
<script>
$(document).ready(function(){

$(".kurir").each(function(o_index,o_val){
    $(this).on("change",function(){
        var did=$(this).val();
        var berat="<?php echo $total['total_berat']; ?>";
        var kota="<?php echo $rows['kota_id']; ?>";
        $.ajax({
          method: "get",
          dataType:"html",
          url: "<?php echo base_url(); ?>produk/kurirdata",
          data: "kurir="+did+"&berat="+berat+"&kota="+kota,
          beforeSend:function(){
            $("#oksimpan").hide();
          }
        })
        .done(function( x ) {           
            $("#kurirserviceinfo").html(x);
            $("#kuririnfo").show();         
        })
        .fail(function(  ) {
            $("#kurirserviceinfo").html("");
            $("#kuririnfo").hide();
        });
    });
});





$("#diskon").html(toDuit(0));
hitung();
});

function hitung(){
    var diskon=$('#diskonnilai').val();
    var total=$('#total').val();
    var ongkir=$("#ongkir").val();
    var bayar=(parseFloat(total)+parseFloat(ongkir));
    if(parseFloat(ongkir) > 0){
        $("#oksimpan").show();
    }else{
        $("#oksimpan").hide();
    }
    $("#totalbayar").html(toDuit(bayar));
}
</script>

<?php 
#echo "<div style='clear:both'></div><hr><br>$ket[keterangan]"; 
}
?>
<!-- <div class="col-sm-4 colom4">
</div>
  <?php $res = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.id_reseller='$rows[id_reseller]'")->row_array(); ?>
  <table class='table table-condensed'>
  <tbody>
    <tr class='alert alert-info'><th scope='row' style='width:90px'>Pengirim</th> <td><?php echo $res['nama_reseller']?></td></tr>
    <tr class='alert alert-info'><th scope='row'>Alamat</th> <td><?php echo $res['alamat_lengkap'].', '.$res['nama_kota'].', '.$res['nama_provinsi']; ?></td></tr>
  </tbody>
  </table>

  <?php $usr = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM rb_konsumen a JOIN rb_kota b ON a.kota_id=b.kota_id 
                JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id
                  where a.id_konsumen='".$this->session->id_konsumen."'")->row_array(); ?>
  <table class='table table-condensed'>
  <tbody>
    <tr class='alert alert-danger'><th scope='row' style='width:90px'>Penerima</th> <td><?php echo $usr['nama_lengkap']?></td></tr>
    <tr><th scope='row'>Alamat</th> <td><?php echo $usr['alamat_lengkap'].', '.$usr['nama_kota'].', '.$usr['nama_provinsi']; ?></td></tr>
  </tbody>
  </table>
    <img style='width:100%' src='<?php echo base_url(); ?>asset/foto_pasangiklan/ekpedisi2.jpg'>

</div> -->


<!-- <div class="corplat-mother-container">
    <div id="treats-root">
        <div>
            <div></div>
            <div>
                <div>
                    <div class="css-w91ivc">
                        <div class="css-12i6wp8 corplat-mother-container">
                            <div class="corplat-mother-container-left">
                                <div class="corplat-mother-container-left__content" style="min-height: 321px;">
                                    <div class="css-6x7r8f">
                                        <div class="css-1dzz2c4">
                                            <div class="gsu-margt-20px"></div>
                                            <div class="corplat-sidebar-top-pitcher"></div>
                                            <div class="header-tickers-wrapper"></div>
                                            <div class="carts-group-valid">
                                                <div>
                                                 ZZZZZDiisi Isi
                                            </div>
                                        </div>
                                        <div class="corplat-sidebar-bottom-pitcher"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="corplat-mother-container-right">
                            <div class="css-c7ff21">
                                <div id="corplat-sidebar-positioner" class="summary-positioner" style="left: 0px; top: 20px; position: absolute; height: 0px; bottom: auto; right: auto;">
                                    <div class="css-1dzz2c4">
                                        <div class="summary-wrapper summary-position-initiated">
                                            <div class="fixed-wrapper">
                                                <section class="corplat-sidebar-card css-vuebij-unf-card eyk31ek0">
                                                    <div>
                                                        <div class="sidebar-heading-text">Ringkasan Belanja</div>
                                                        <div class="summary-details-n-insc-wrapper">
                                                            <div class="summary-details-wrapper">
                                                                <div class="summary-detail">
                                                                    <div class="summary-detail__label">Total Harga</div>
                                                                    <div class="summary-detail__value">Rp495.000</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="summary-shops-sum-potential-cashback-row">
                                                            <div class="summary-shops-sum-potential-cashback-box">
                                                                <div class="summary-shops-sum-potential-cashback__label">Potensi Cashback Toko</div>
                                                                <div class="summary-shops-sum-potential-cashback__value">Rp24.750</div>
                                                            </div>
                                                        </div>
                                                        <div class="summary-main-btns-wrapper">
                                                            <div class="summary-main-btn">
                                                                <div role="presentation">
                                                                    <button class="css-t0f30v-unf-btn e1ggruw00">
                                                                        <span>Beli (1)</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div> -->

