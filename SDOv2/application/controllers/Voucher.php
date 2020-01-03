<?php
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Voucher extends CI_Controller {
	public function index(){
		$data['title'] = 'Semua Voucher';
		$data['record'] = $this->db->query("SELECT * FROM rb_voucher ORDER BY id_voucher");
		$this->template->load(template().'/template',template().'/voucher',$data);
	}

	public function details(){
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM rb_voucher where code='$ids'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('main');
	        }
		$data['title'] = $row->nama_voucher;
		$data['record'] = $this->model_app->view_where('rb_voucher',array('code'=>$row->code))->row_array();
		$this->template->load(template().'/template',template().'/voucher_details',$data);
	}

	public function claim(){
		cek_session_members();
		$idmember = $this->session->id_konsumen;
		$ids = $this->uri->segment(3);
		$recordd = $this->db->query("SELECT * FROM `voucher_user`  where id_konsumen='$idmember'")->row_array();		
		$rows = $this->db->query("SELECT * FROM `rb_voucher` where code='$ids'")->row_array();
		$data = array('id_voucher'=>$rows[id_voucher],
                            'id_konsumen'=>$idmember,
							'use'=> 'N',
							'datenow'=>date('Y-m-d'),
							'berlaku'=>date('Y-m-d', strtotime("+14 days")));
		$data1 = array('jumlah'=>$rows[jumlah]-1);
		$where = array('code' => $ids);
		if($recordd[id_voucher]==$rows[id_voucher]){
			redirect('voucher/gagal');
		}else{
			$this->model_app->insert('voucher_user',$data);
			$this->model_app->update('rb_voucher', $data1, $where);
			redirect('members/voucher');
		}
	}

	public function y(){
	$data['record'] = $this->model_app->view_where('rb_voucher',array('code'=>$row->code))->row_array();
		$this->template->load(template().'/template',template().'/reseller/vouch_detail',$data);
	$id = array('id_produk' => $this->uri->segment(3));
        $this->model_app->delete('rb_produk',$id);
        redirect('reseller/produk');
	}

}
