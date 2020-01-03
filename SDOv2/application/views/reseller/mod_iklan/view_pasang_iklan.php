<?php
$saldo = $this->db->query("SELECT * FROM `rb_saldo_iklan` WHERE id_reseller='".$this->session->id_reseller."'")->row_array();
#echo $this->session->id_reseller;
?>
<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Request Iklan | <?php echo "Saldo : Rp ".rupiah($saldo[jumlah]); ?> </h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>reseller/tambah_iklan'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Tujuan</th>
                        <th>Letak</th>
                        <th>Durasi</th>
                        <th>Anggaran</th>
                        <th>Tanggal Apply</th>
                        <th>Status</th>
                        <th style='width:80px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      if ($row['status']=='Y'){ $status = "<small><i style='color:green'>Disetujui</i></small>"; }else{ $status = "<small><i style='color:red'>Proses...</i></small>"; }
                    echo "<tr><td>$no</td>
                              <td>$row[tempat]</td>
                              <td>$row[posisi]</td>
                              <td>$row[durasi]</td>
                              <td>Rp <span style='text-decoration:$line'>".rupiah($row['harga'])."</span> $harga</td>
                              <td>$row[tanggal_req]</td>
                              <td>$status</td>
                              <td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."reseller/hapus_iklan/$row[id_iklan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table><hr>
              </div>