<?php
//$rows = $this->db->query("SELECT * FROM voucher_user JOIN rb_konsumen ON voucher_user.id_konsumen = rb_konsumen.id_konsumen JOIN rb_voucher ON voucher_user.id_voucher = rb_voucher.id_voucher where rb_voucher.code=$record[code]")->row_array();
$rows = $this->db->query("SELECT * FROM `rb_voucher` where code='$record[code]'")->row_array();
$exp = $this->db->query("SELECT * FROM `voucher_user` where id_konsumen='".$this->session->id_konsumen."' AND id_voucher='$record[id_voucher]'")->row_array();
?>

<div class="_145I_9Cr"
  ><div class="css-1ymlql">
    <img src="https://ecs7.tokopedia.net/img/blog/promo/2019/11/Desktop_960x160-9.jpg" class="NgqaIVvp">
    <div class="css-1ba9y97">
      <div class="css-4a7qeg"><?php echo $rows[nama_voucher]; ?></div>
      <div class="css-1jko6h3">
        <div class="css-z8bb4s">Syarat &amp; Ketentuan</div>
        <div class="css-5xjrq2">
          <ol>
            <li>Kupon Diskon Rp30.000 untuk Pembelanjaan di Tokopedia menggunakan OVO PayLater dengan minimal transaksi Rp30,000</li>
            <li>Promo hanya berlaku untuk pembayaran penuh OVO PayLater.</li>
            <li>Untuk mendapatkan Kupon Ongkos Kirim, pengguna harus melakukan aktivasi OVO. Jika tidak mengaktifkan dalam 7 hari setelah mengikuti promo, Cashback akan hangus.&nbsp;</li>
            <li>Tidak berlaku untuk transaksi pembelian Dropshipper.&nbsp;</li>
            <li>Promo hanya berlaku untuk satu kali untuk pembelanjaan di Toko dengan Power Merchant &amp; Official Store di Tokopedia.</li>
            <li>Untuk mendapatkan benefit pastikan Aplikasi anda sudah terupdate.</li>
            <li>Tidak bisa digabung dengan promo lain.</li>
            <li>Satu pengguna Tokopedia hanya boleh menggunakan 1 (satu) akun Tokopedia untuk mengikuti promo ini. Jika ditemukan pembuatan lebih dari 1 (satu) akun oleh 1 (satu) pengguna yang sama dan/atau nomor handphone yang sama dan/atau alamat yang sama dan/atau ID pelanggan yang sama dan/atau identitas pembayaran yang sama dan/atau riwayat transaksi yang sama, maka pengguna tidak akan mendapatkan benefit dari promo Tokopedia.</li>
            <li>Tokopedia berhak melakukan tindakan yang diperlukan apabila diduga terjadi tindakan kecurangan dari pengguna yang merugikan pihak Tokopedia.</li>
            <li>Dengan menggunakan Kupon ini, pengguna dianggap mengerti dan menyetujui semua Syarat &amp; Ketentuan yang berlaku.</li>
          </ol>
        </div>
      </div>
      <div class="css-ow7tq6">
        <div class="css-z8bb4s">Cara Pakai</div>
        <div class="css-5xjrq2">
          <ol>
            <li><span style="white-space: pre-wrap;">Masuk ke halaman Kupon Saya dan pilih Kupon.</span></li>
            <li><span style="white-space: pre-wrap;">Masukkan produk yang Anda pilih ke keranjang belanja.</span></li>
            <li><span style="white-space: pre-wrap;">Pada halaman Keranjang Belanja, klik bagian "Gunakan Kode Promo atau Kupon"</span></li>
            <li><span style="white-space: pre-wrap;">Klik Tab Kupon Saya dan pilih jenis Kupon yang ingin digunakan.</span></li>
            <li><span style="white-space: pre-wrap;">Kode akan berhasil digunakan apabila pembelian barang telah sesuai dengan Syarat dan Ketentuan yang berlaku.</span></li>
            <li><span style="white-space: pre-wrap;">Jika berhasil, akan ada informasi kode Promo yang digunakan beserta potensial Cashback.</span></li>
          </ol>
          <span style="white-space: pre-wrap;"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="css-ysm8ew">
    <div class="css-86dzfg">Detail Kupon</div>
    <div class="css-1rxwvrv">
      <img src="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/images/clock2.svg" class="_2S1Wo2BA" width="24px" alt="masa berlaku">
      <span class="css-s5r243">Berlaku hingga</span>
      <span class="css-1lp36uo"><strong><?php $phpdate = strtotime( $exp[berlaku] );
                                              $mysqldate = date( 'Y-m-d', $phpdate ); echo tgl_indo($mysqldate); ?></strong></span>
    </div>
    <div class="css-1rxwvrv" style="margin-top: 16px;">
      <?php  if($exp[berlaku]<=date('Y-m-d')){ $berlaku="Kadaluarsa"; }else{ $exp = strtotime($exp[berlaku]);
                                                                             $datenow = strtotime(date('Y-m-d'));
                                                                             $kurang = $exp-$datenow;
                                                                             $x = abs(floor($kurang / (60*60*24))); 
                                                                             $berlaku=$x." Hari"; }; ?>
      <img src="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/images/clock2.svg" class="_2S1Wo2BA" width="24px" alt="transaction">
      <span class="css-s5r243">Masa Berlaku</span><span class="css-1lp36uo"><?php echo $berlaku ?></span>
    </div>
    <div class="css-1rxwvrv" style="margin-top: 16px;">
      <img src="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/images/rupiah.svg" class="_2S1Wo2BA" width="24px" alt="transaction">
      <span class="css-s5r243">Minimum transaksi</span><span class="css-1lp36uo"><?php echo "Rp. " .rupiah($rows[min_trx]) ?></span>
    </div>
  </div>
</div>


  <div class="ajg" style="top: 235px;">
    <?php if($mysqldate<=date('Y-m-d')){ ?>
      <button class="css-152zot5-unf-btndisable e1ggruw00" style="width:324px; ">
        <span>Gunakan</span></a>
      </button>
    <?php }else{ ?>
    <button class="css-152zot5-unf-btn e1ggruw00" onclick="location.href='<?php echo base_url(); ?>members/keranjang'" style="width:324px;">
      <a href="<?php echo base_url(); ?>members/keranjang/<?php echo $record[code]; ?>"><span>Gunakan</span></a>
    </button>
    <?php }; ?>
  </div>

<?php 
$firstweek = date('d F Y', strtotime("first this month"));

echo $mysqldate;
#echo $exp[berlaku];
#echo tgl_indo(date('Y-m-d'));
#echo $x;

?>