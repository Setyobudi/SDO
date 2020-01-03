<style>
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 50px;
  height: 15px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}
</style>

<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Iklan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_iklan',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Tujuan</th>    <td><input type='radio' name='a' required value='Beranda Toko'>Beranda Toko <p><input type='radio' name='a' required value='Informasi Produk'>Informasi Produk</td></tr>
                    <tr><th width='120px' scope='row'>Letak</th>    <td><input type='radio' name='b' required value='Home PekanRaya.id'>Home PekanRaya.id
                    <p><input type='radio' name='b' required value='Kategori'>Kategori</td></tr>
                    <tr><th scope='row'>Durasi</th>                   <td><div class='slidecontainer'><input type='range' min='1' max='30' value='10' class='slider' id='rangedurasi' style='width:200px' name='c'>
                    <p><span id='jmlhari'></span> Hari | *maks 30 hari</p></div></td></tr>
                    <tr><th scope='row'>Anggaran</th>                   <td><div class='slidecontainer'><input type='range' min='1' max='50000' value='1000' class='slider' id='rangeharga' style='width:200px' name='d'>
                    <p>Rp. <span id='jmlharga'></span> | Maks Rp. 50.000</p></div></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/pasangiklan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>
            
            <script>
var slider = document.getElementById('rangedurasi');
var output = document.getElementById('jmlhari');
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}

var slider = document.getElementById('rangeharga');
var output1 = document.getElementById('jmlharga');
output1.innerHTML = slider.value;

slider.oninput = function() {
  output1.innerHTML = this.value;
}
</script>
            ";
