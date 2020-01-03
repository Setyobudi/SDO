<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Voucher</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_voucher',$attributes);
              if ($rows['img']==''){ $foto = 'voucher.jpg'; }else{ $foto = $rows['img']; } 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_voucher]'>
                    <tr><th width='120px' scope='row'>Nama Voucher</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_voucher]' required></td></tr>
                    <tr><th scope='row'>Kode</th>                 <td><input type='text' class='form-control' name='b' value='$rows[code]'></td></tr>
                    <tr><th scope='row'>Diskon</th>                   <td><input type='text' class='form-control' name='c' value='$rows[diskon]'></td></tr>
                    <tr><th scope='row'>Jumlah</th>                   <td><input type='text' class='form-control' name='d' value='$rows[jumlah]'></td></tr>
                    <tr><th scope='row'>Min Pembelanjaan</th>                   <td><input type='text' class='form-control' name='e' value='".rupiah($rows[min_trx])."'></td></tr>
                    <tr><th scope='row'>Maks. Diskon</th>                   <td><input type='text' class='form-control' name='f' value='".rupiah($rows[max])."'></td></tr>
                    <tr><th scope='row'>Tanggal Kadaluarsa</th>                   <td><input type='datetime-local' class='form-control' name='g' value='$rows[exp_date]'></td></tr>
                    <tr><th scope='row'>Ganti Foto</th>                     <td><input type='file' class='form-control' name='h'><hr style='margin:5px'>";
                    if ($rows['img'] != ''){ echo "<i style='color:red'>Foto Saat ini : </i><a target='_BLANK' href='".base_url()."asset/images/voucher/$rows[img]'>$rows[img]</a>"; } echo "</td></tr></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/voucher'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                  </div>
            </div>";
