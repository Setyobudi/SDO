<p class='sidebar-title block-title'>Semua Voucher</p>
<div class="css-ly51oj">
<?php 
foreach($record->result_array() as $row) {
  $ex = explode(';', $row['img']);
    if (trim($ex[0])==''){ $foto_voucher = 'no-image.png'; }else{ $foto_voucher = $ex[0]; }
  echo" <div class='css-1xmjwkv'>
  <div class='_1-m8mrOw  _3cziUqzE'>
  <a class= 'iqDv58y7' href='".base_url()."voucher/details/$row[code]'>
  <img src='".base_url()."asset/images/voucher/$foto_voucher' class='_1-VIa0Gg'></a>
  <div class='_16nUiETY _2pQNSndc'>
    <div class='_1A6EElIJ'>
      <div class='_2xl1GokD sTjyFpbA'>
        <img class='_3lzLiQEK' src='".base_url()."template/".template()."/background/images/clock.svg'>
        <div class='_2t-WjIZ2'>
          <div class='GmQ-uniq'>Berlaku hingga</div>
          <div class='_36VNSkZf _3I9jzbLV'>"; $phpdate = strtotime( $row[date_exp] );
                                            $mysqldate = date( 'd F Y', $phpdate );  echo $mysqldate; echo"</div>
        </div>
      </div>
      <div class='_2FeVd4dm sTjyFpbA'>
        <img class='_3lzLiQEK' src='".base_url()."template/".template()."/background/images/money.svg'>
        <div class='_2t-WjIZ2'>
          <div class='GmQ-uniq' style='width: auto;'>Min. transaksi</div>
          <div class='_36VNSkZf '> Rp." .rupiah($row[min_trx])."</div>
        </div>
      </div>
    </div>
  </div>
</div></div>";

}
?>

</div>