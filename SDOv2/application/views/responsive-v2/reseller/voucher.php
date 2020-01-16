                   <!-- <?php 
                    $no = 1;
                    foreach ($record->result_array() as $rows){
                    echo "<tr><td>$no</td>
                              <td>$rows[use]</td>
                              <td>$rows[diskon]</td>
                              <td>$rows[max]</td>
                              <td>$rows[use]</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_rekening/$row[id_rekening_reseller]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_rekening/$row[id_rekening_reseller]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?> -->

<p class='sidebar-title block-title'>Voucher Anda</p>
<div class="css-ly51oj">
<?php 
foreach($record->result_array() as $rows) {
  $phpdate = strtotime( $rows[berlaku] );
  $mysqldate = date( 'Y-m-d', $phpdate );
  if($rows[berlaku]<=date('Y-m-d')){ $berlaku="Kadaluarsa"; }else{ $berlaku=tgl_indo($mysqldate); };
  $ex = explode(';', $rows['img']);
    if (trim($ex[0])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
  echo" <div class='css-1xmjwkv'>
  <div class='_1-m8mrOw  _3cziUqzE'>
  <a class= 'iqDv58y7' href='".base_url()."members/vocdetails/$rows[code]'>
  <img src='".base_url()."asset/images/voucher/$foto_produk' class='_1-VIa0Gg'></a>
  <div class='_16nUiETY _2pQNSndc'>
    <div class='_1A6EElIJ'>
      <div class='_2xl1GokD sTjyFpbA'>
        <img class='_3lzLiQEK' src='".base_url()."template/".template()."/background/images/clock.svg'>
        <div class='_2t-WjIZ2'>
          <div class='GmQ-uniq'>Berlaku hingga</div>
          <div class='_36VNSkZf _3I9jzbLV'>";   echo $berlaku; echo"</div>
        </div>
      </div>
      <div class='_2FeVd4dm sTjyFpbA'>
        <img class='_3lzLiQEK' src='".base_url()."template/".template()."/background/images/money.svg'>
        <div class='_2t-WjIZ2'>
          <div class='GmQ-uniq' style='width: auto;'>Min. transaksi</div>
          <div class='_36VNSkZf '> Rp." .rupiah($rows[min_trx])."</div>
        </div>
      </div>
    </div>
  </div>
</div></div>";

}
?>

</div>
