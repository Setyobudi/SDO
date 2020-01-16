<?php 

$record = $this->db->query("SELECT COUNT(*) as blmbyr FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_pembeli='".$this->session->id_konsumen."' AND a.proses='0'")->row_array();
$record1 = $this->db->query("SELECT COUNT(*) as proses FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_pembeli='".$this->session->id_konsumen."' AND a.proses='1'")->row_array();
$record2 = $this->db->query("SELECT COUNT(*) as konfirm FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_pembeli='".$this->session->id_konsumen."' AND a.proses='2'")->row_array();
?>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="md-margin"></div><!-- space -->
                <div class="main-tab-container carousel-wrapper">
                    <ul id="products-tabs-list" class="tab-style-2 clearfix">
                        <li class="active"><a href="#akun" data-toggle="tab">Pengaturan Akun</a></li>
                        <li><a href="#voucher" data-toggle="tab">Voucher</a></li>
                    </ul>

                    <div id="products-tabs-content" class="tab-content row">
                        <div class="tab-pane active tab-carousel-wrapper" id="akun">
                            <div class="owl-single-col">
                                    <p>
                                    Data Profile Anda <br>
                                    Berikut Informasi Data Profile anda. <br>
                                    Pastikan data-data dibawah ini sudah benar, agar tidak terjadi kesalahan saat transaksi. <br> </p>
                                    <table class="table-hover table-condensed">
                                        <thead>
                                            <tr><td width='170px'><b>Username</b></td> <td><b style='color:red'><?php echo $row['username'] ?></b></td></tr>
                                            <tr><td><b>Nama Lengkap</b></td>           <td><?php echo $row['nama_lengkap'] ?></td></tr>
                                            <tr><td><b>Email</b></td>                  <td><?php echo $row['email'] ?></td></tr>
                                            <tr><td><b>Jenis Kelamin</b></td>          <td><?php echo $row['jenis_kelamin'] ?></td></tr>
                                            <tr><td><b>Tanggal Lahir</b></td>          <td><?php echo $row['tanggal_lahir'] ?></td></tr>
                                            <tr><td><b>Tempat Lahir</b></td>           <td><?php echo $row['tempat_lahir'] ?></td></tr>
                                            <tr><td><b>Alamat</b></td>                 <td><?php echo $row['alamat_lengkap'] ?></td></tr>
                                            
                                            <tr><td><b>Propinsi</b></td>               <td><?php echo $detail['result']['province'] ?></td></tr>
                                            <tr><td><b>Kota</b></td>                   <td><?php echo $detail['result']['city'] ?></td></tr>
                                            <tr><td><b>Kecamatan</b></td>              <td><?php echo $detail['result']['subdistrict_name'] ?></td></tr>
                                            <tr><td><b>No Hp</b></td>                  <td><?php echo $row['no_hp'] ?></td></tr>
                                        </thead>
                                    </table>
                                    
                                <!-- End .owl-single-col  -->
                            </div><!-- End .latest-tab-slider -->
                        </div>

                        <div class="tab-pane tab-carousel-wrapper" id="voucher">
                            <div class="owl-single-col">
                                SOON
                            </div><!-- End .owl-single-col  -->
                        </div><!-- End .latest-tab-slider -->
                    </div>

                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
<?php /*
echo "<table id='example11' class='table table-hover table-condensed'>
  <thead>
    <tr>
      <th width='20px'>No</th>
      <th>Nama Penjual</th>
      <th>Belanja & Ongkir</th>
      <th>Status</th>
      <th>Total + Ongkir</th>
      <th></th>
    </tr>
  </thead>
  <tbody>";

      $no = 1;
      $record = $this->model_reseller->orders_report($this->session->id_konsumen,'reseller');
      foreach ($record->result_array() as $row){
      if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
      $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
      echo "<tr><td>$no</td>
                <td><a href='".base_url()."members/detail_reseller/$row[id_reseller]'><small><b>$row[nama_reseller]</b></small><br><small class='text-success'>$row[kode_transaksi]</small></a></td>
                <td><span style='color:blue;'>Rp ".rupiah($total['total'])."</span> <br> <small><i style='color:green;'><b style='text-transform:uppercase'>$row[kurir]</b> - Rp ".rupiah($row['ongkir'])."</i></small></td>
                <td>$proses <br><small>$row[nama_reseller]</small></td>
                <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                <td width='130px'>";
                if ($row['proses']=='0'){
                  echo "<a style='margin-right:3px' class='btn btn-success btn-sm' title='Konfirmasi Pembayaran' href='".base_url()."konfirmasi?kode=$row[kode_transaksi]'>Konfirmasi</a>";
                }else{
                  echo "<a style='margin-right:3px' class='btn btn-default btn-sm' href='#'  onclick=\"return confirm('Maaf, Pembayaran ini sudah di konfirmasi!')\">Konfirmasi</a>";
                }
              
              echo "<a class='btn btn-info btn-sm' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span></a></td>
            </tr>";
        $no++;
      }

  echo "</tbody>
</table>"; */
?>