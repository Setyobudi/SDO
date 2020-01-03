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
class Landingpage extends CI_Controller {
	public function index(){
		$data['title'] = 'Landingpage';
		$data['row'] = $this->db->query("SELECT * FROM rb_reseller WHERE id_reseller='".$this->$post->id_reseller."'");
		#$this->template->load(template().'/template',template().'/landingpage',$data);
	}

    public function details(){
		$ids = $this->uri->segment(3);
        $dat = $this->db->query("SELECT * FROM rb_reseller WHERE id_reseller='$ids'");
        $halah = $dat = $this->db->query("SELECT * FROM rb_reseller WHERE id_reseller='$ids'")->row_array();
	    #$row = $dat->row();
	    #$total = $dat->num_rows();
	    #    if ($total == 0){
	     #   	redirect('main');
	    #    }
		$data['title'] = $row->nama_voucher;
        $data['rowd'] = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$row->id_reseller))->row_array();
        
        if($halah[tipe_member]=='Free Member'){
            $data['rows'] = $this->db->query("SELECT * FROM rb_landingpage a JOIN lp_free b JOIN rb_reseller c ON a.id_lp_freeuser = b.id_lpfree and a.id_reseller=c.id_reseller WHERE a.id_reseller='$ids' AND a.id_lp_freeuser='1'")->row_array();
            $this->load->view('landingpagefree',$data);
        }elseif($halah[tipe_member]=='Elite Member'){
            $data['rows'] = $this->db->query("SELECT * FROM rb_landingpage a JOIN lp_free b JOIN rb_reseller c ON a.id_lp_elite = b.id_lpfree and a.id_reseller=c.id_reseller WHERE a.id_reseller='$ids' AND a.id_lp_freeuser='1'")->row_array();
            $this->template->load('landingpageelit',$data);
        }
	}
}
