<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	function index(){
		$jumlah= $this->model_app->view('rb_produk')->num_rows();
		$config['base_url'] = base_url().'produk/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}

		if (is_numeric($dari)) {
			$data['iklantengah'] = $this->model_iklan->iklan_tengah();
			if ($this->input->post('cari')!=''){
				$data['title'] = title();
				$data['judul'] = "Hasil Pencarian keyword - ".filter($this->input->post('cari'));
				$data['record'] = $this->model_app->cari_produk(filter($this->input->post('cari')));
			}else{
				$data['title'] = title();
				$data['judul'] = 'Semua Produk';
				$data['record'] = $this->model_app->view_ordering_limit('rb_produk','id_produk','DESC',$dari,$config['per_page']);
				$this->pagination->initialize($config);
			}
				$this->template->load('phpmu-one/template','phpmu-one/view_home',$data);
		}else{
			redirect('main');
		}
	}

	function kategori(){
		$cek = $this->model_app->edit('rb_kategori_produk',array('kategori_seo'=>$this->uri->segment(3)))->row_array();
		$jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
		$config['base_url'] = base_url().'main/kategori/'.$this->uri->segment(3);
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = "Produk Kategori $cek[nama_kategori]";
			$data['judul'] = "Produk Kategori $cek[nama_kategori]";
			$data['iklantengah'] = $this->model_iklan->iklan_tengah();
			$data['record'] = $this->model_app->view_where_ordering_limit('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']),'id_produk','DESC',$dari,$config['per_page']);
			$this->pagination->initialize($config);
			$this->template->load('phpmu-one/template','phpmu-one/view_home',$data);
		}else{
			redirect('main');
		}
	}

	function detail(){
		$query = $this->model_app->edit('rb_produk',array('produk_seo'=>$this->uri->segment(3)));
		if ($query->num_rows()>=1){
			$cek = $query->row_array();
			$data['title'] = "$cek[nama_produk]";
			$data['judul'] = "$cek[nama_produk]";
			$data['row'] = $this->model_app->view_where('rb_produk',array('id_produk'=>$cek['id_produk']))->row_array();
			$data['kons'] = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
			$this->template->load('phpmu-one/template','phpmu-one/view_produk_detail',$data);
		}else{
			redirect('main');
		}
	}

	function keranjang(){
		$id_produk   = filter($this->input->post('id_produk'));
		$jumlah   = filter($this->input->post('jumlah'));
		$keterangan   = filter($this->input->post('keterangan'));
		$ex = explode(';', $jumlah);
		$durasi = $ex[0];
		$harga = $ex[1];

		if ($id_produk!=''){
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					$idp = 'TRX-'.date('YmdHis');
					$this->session->set_userdata(array('idp'=>$idp));
				}

				$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
				if ($cek >=1){
					$this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$jumlah where session='".$this->session->idp."' AND id_produk='$id_produk'");
				}else{
					
					$data = array('session'=>$this->session->idp,
				        		  'id_produk'=>$id_produk,
				        		  'jumlah'=>$durasi,
				        		  'harga_jual'=>$harga,
								  
								  'keterangan_order'=>$keterangan,
				        		  'waktu_order'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_penjualan_temp',$data);
				}
				redirect('produk/keranjang');
			
		}else{
				$data['record'] = $this->model_app->view_join_rows('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
				$data['title'] = 'Keranjang Belanja';
				$this->template->load('phpmu-one/template','phpmu-one/pengunjung/view_keranjang',$data);

		}
	}

	function keranjang_delete(){
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('rb_penjualan_temp',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_temp where session='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		redirect('produk/keranjang');
	}

	function kurirdata(){
		$iden = $this->model_app->view_ordering_limit('identitas','id_identitas','DESC',0,1)->row_array();
		$this->load->library('rajaongkir');
		$tujuan=$this->input->get('kota');
		$dari=$iden['kota_id'];
		$berat=$this->input->get('berat');
		$kurir=$this->input->get('kurir');
		$dc=$this->rajaongkir->cost($dari,$tujuan,$berat,$kurir);
		$d=json_decode($dc,TRUE);
		$o='';
		if(!empty($d['rajaongkir']['results'])){
			$data['data']=$d['rajaongkir']['results'][0]['costs'];
			$this->load->view('phpmu-one/pengunjung/kurirdata',$data);			
		}else{
			$data['ongkir'] = 0;
			$this->load->view('phpmu-one/pengunjung/kurirdata',$data);	
		}
	}

	function checkouts(){
		if (isset($_POST['submit'])){
			if ($this->session->idp!=''){
				$this->load->library('email');
				$data = array('kode_transaksi'=>$this->session->idp,
			        		  'id_pembeli'=>$this->session->id_konsumen,
			        		  'diskon'=>$this->input->post('diskonnilai'),
			        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        		  'proses'=>'0');
				$this->model_app->insert('rb_penjualan',$data);
				$idp = $this->db->insert_id();

				$keranjang = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp));
				foreach ($keranjang->result_array() as $row) {
					$dataa = array('id_penjualan'=>$idp,
				        		   'id_produk'=>$row['id_produk'],
								   'jumlah'=>$row['jumlah'],
								   'keterangan_order'=>$row['keterangan_order'],
				        		   'harga_jual'=>$row['harga_jual']);
					$this->model_app->insert('rb_penjualan_detail',$dataa);
				}
				$this->model_app->delete('rb_penjualan_temp',array('session'=>$this->session->idp));
				$kons = $this->model_app->view_join_where_one('rb_konsumen','rb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();

				$data['title'] = 'Transaksi Success';
				$data['email'] = $kons['email'];
				$data['orders'] = $this->session->idp;
				$data['total_bayar'] = rupiah($this->input->post('total')+$this->input->post('ongkir'));

				$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
				$data['rekening'] = $this->model_app->view('rb_rekening');

				$email_tujuan = $kons['email'];
				$tgl = date("d-m-Y H:i:s");

				$subject      = "$iden[nama_website] - Detail Orderan anda";
				$message      = "<html><body>Halooo! <b>$kons[nama_lengkap]</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tgl</span> Anda telah order produk di $iden[nama_website].
					<br><table style='width:100%;'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
						<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : $kons[nama_lengkap]</td></tr>
						<tr><td><b>Alamat Email</b></td>			<td> : $kons[email]</td></tr>
						<tr><td><b>No Telpon</b></td>				<td> : $kons[no_hp]</td></tr>
						<tr><td><b>Alamat</b></td>					<td> : $kons[alamat_lengkap] </td></tr>
						<tr><td><b>Kabupaten/Kota</b></td>			<td> : $kons[nama_kota] </td></tr>
					</table><br>

					No. Invoice : <b>".$this->session->idp."</b><br>
					Berikut Detail Data Orderan Anda :
					<table style='width:100%;' class='table table-striped'>
				          <thead>
				            <tr bgcolor='#337ab7'>
				              <th style='width:40px'>No</th>
				              <th width='47%'>Nama Produk</th>
				              <th>Harga</th>
				              <th>Qty</th>
				              <th>Berat</th>
				              <th>Total</th>
				            </tr>
				          </thead>
				          <tbody>";

				          $no = 1;
				          $belanjaan = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$idp),'id_penjualan_detail','ASC');
				          foreach ($belanjaan as $row){
				          $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
				          if ($row['diskon']!='0'){ $diskon = "<del style='color:red'>".rupiah($row['harga_jual'])."</del>"; }else{ $diskon = ""; }
				          if (trim($row['gambar'])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $row['gambar']; }
				          $diskon_total = $diskon_total+$row['diskon']*$row['jumlah'];

				$message .= "<tr bgcolor='#e3e3e3'><td>$no</td>
				                    <td>$row[nama_produk]</td>
				                    <td>".rupiah($row['harga_jual']-$row['diskon'])." $diskon</td>
				                    <td>$row[jumlah]</td>
				                    <td>".($row['berat']*$row['jumlah'])." Gram</td>
				                    <td>Rp ".rupiah($sub_total)."</td>
				                </tr>";
				            $no++;
				          }
				          
				$message .= "<tr bgcolor='lightblue'>
				                  <td colspan='5'><b>Total Berat</b></td>
				                  <td><b>".$this->input->post('berat')." Gram</b></td>
				                </tr>

				                <tr bgcolor='lightblue'>
				                  <td colspan='5'><b>Ongkos Kirim</b></td>
				                  <td><b>".$this->input->post('ongkir')."</b></td>
				                </tr>

				                <tr bgcolor='lightgreen'>
				                  <td colspan='5'><b>Total Harga</b></td>
				                  <td><b>Rp ".rupiah($this->input->post('total')+$this->input->post('ongkir'))."</b></td>
				                </tr>

				        </tbody>
				      </table><br>

				      Silahkan melakukan pembayaran ke rekening :
				      <table style='width:100%;' class='table table-hover table-condensed'>
						<thead>
						  <tr bgcolor='#337ab7'>
						    <th width='20px'>No</th>
						    <th>Nama Bank</th>
						    <th>No Rekening</th>
						    <th>Atas Nama</th>
						  </tr>
						</thead>
						<tbody>";
						    $noo = 1;
						    $rekening = $this->model_app->view('rb_rekening');
						    foreach ($rekening->result_array() as $row){
				$message .= "<tr bgcolor='#e3e3e3'><td>$noo</td>
						              <td>$row[nama_bank]</td>
						              <td>$row[no_rekening]</td>
						              <td>$row[pemilik_rekening]</td>
						          </tr>";
						      $noo++;
						    }
				$message .= "</tbody>
					  </table><br><br>

				      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='".base_url()."konfirmasi'>disini</a><br>
				      Salam. Admin, $iden[nama_website] </body></html> \n";
				
				$this->email->from($iden['email'], $iden['nama_website']);
				$this->email->to($email_tujuan);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$this->session->unset_userdata('idp');
				$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
			}else{
				redirect('produk/keranjang');
			}
		}else{
				if ($this->session->id_konsumen){
					$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp));
					if ($cek->num_rows()>=1){
						$data['title'] = 'Data Pelanggan';
						$data['kota'] = $this->model_app->view_ordering('rb_kota','kota_id','ASC');
						$data['rows'] = $this->model_app->view_join_where_one('rb_konsumen','rb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
						$data['record'] = $this->model_app->view_join_rows('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
						$this->template->load('phpmu-one/template','phpmu-one/view_checkouts',$data);
					}else{
						redirect('produk/keranjang'.$cek);
					}
				}else{
					redirect('auth/login');
				}
		}
	}

	function print_invoice(){
		$data['rows'] = $this->model_app->view_join_where_one('rb_konsumen','rb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
		$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$this->uri->segment(3)."'");
		$this->load->view('phpmu-one/pengunjung/print_invoice',$data);
	}
}
