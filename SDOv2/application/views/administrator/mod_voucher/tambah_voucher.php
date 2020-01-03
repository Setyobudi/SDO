<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Voucher</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_voucher',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Voucher</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_voucher]' required></td></tr>
                    <tr><th scope='row'>Kode</th>                 <td><input type='text' class='form-control' name='b' value='$rows[code]'></td></tr>
                    <tr><th scope='row'>Diskon</th>                   <td><input type='text' class='form-control' name='c' value='$rows[diskon]'></td></tr>
                    <tr><th scope='row'>Jumlah</th>                   <td><input type='text' class='form-control' name='d' value='$rows[jumlah]'></td></tr>
                    <tr><th scope='row'>Min Pembelanjaan</th>                   <td><input type='text' class='form-control' name='e' value='".rupiah($rows[min_trx])."'></td></tr>
                    <tr><th scope='row'>Maks. Diskon</th>                   <td><input type='text' class='form-control' name='f' value='".rupiah($rows[max])."'></td></tr>
                    <tr><th scope='row'>Tanggal Kadaluarsa</th>                   <td><input type='datetime-local' class='form-control' name='g' value='$rows[exp_date]'></td></tr>
                    <tr><th scope='row'>Foto Voucher</th>                     <td><input type='file' id='fileupload' class='form-control' name='h'>Single File : .gif, jpg, png
                                                                                  <div id='dvPreview'></div> </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
