<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Voucher</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_voucher'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Voucher</th>
                        <th>Kode</th>
                        <th>Diskon (%)</th>
                        <th>Jumlah</th>
                        <th>Min Pembelanjaan</th>
                        <th>Maks. Diskon</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                        $res = $this->db->query("SELECT * FROM rb_voucher ")->row_array();
                        $phpdate = strtotime( $row[date_exp] );
                        $mysqldate = date( 'd-m-Y', $phpdate );
                    echo "<tr><td>$no</td>
                              <td>$row[nama_voucher]</td>
                              <td>$row[code]</td>
                              <td>$row[diskon]</td>
                              <td>$row[jumlah]</td>
                              <td>".rupiah($row[min_trx])."</td>
                              <td>".rupiah($row[max])."</td>
                              <td>$mysqldate</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_voucher/$row[id_voucher]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_voucher/$row[id_voucher]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>