<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wids extends CI_Controller {


	function __construct()
	{
		
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" AND $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		$this->load->model('Mwids');
		$this->load->model('Mpertanyaan');
		$this->load->model('Mjawaban');
		$this->load->model('Mpelajaran');
		$this->load->model('Muser_wids');
		$this->load->model('Users');
	}


	function data_wids()	{
		$data['wids'] = $this->Mwids->get_wids($this->uri->rsegment(3));
		$this->load->view('wids/data_wids', $data);	
	}


	function wids_action(){
		$this->form_validation->set_rules('wids', 'Wids', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('aksi', 'Wids', 'required|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg_error', validation_errors());
			redirect(base_url().'data_wids/'.$this->uri->rsegment(3),'refresh');
		}
		else{
			$user = $this->Users->get_user_by_id($this->uri->rsegment(3))->row_array();
			if($user){
				if($this->input->post('aksi') == "tambah"){
					$wids = $user['wids'] + $this->input->post('wids');
				}
				else{
					$wids = $user['wids'] - $this->input->post('wids');
				}

				$users= array('wids' => $wids,
							  'id'   => $user['id']);

				$data = array('id_user' => $user['id'],
							  'wids'	=> $this->input->post('wids'),
							  'action'  => $this->input->post('aksi'),
							  'keterangan' => $this->input->post('keterangan'));

				$this->Mwids->add_wids($data, $users);
				$this->session->set_flashdata('msg_success', 'Wids berhasil di'.$this->input->post('aksi'));
				redirect(base_url().'data_wids/'.$this->uri->rsegment(3) , 'refresh');
			}
			else {
				redirect(base_url().'users','refresh');
			}
				
		}
	}


	function voucher_wids(){
		$data['no'] = 1;
		$data['wids'] = $this->Mwids->get_voucher_wids();
		$this->load->view('wids/data_voucher', $data);
	}

	function add_voucher(){
		$this->form_validation->set_rules('kode_voucher', 'Kode Voucher', 'required|xss_clean');
		$this->form_validation->set_rules('wids', 'Wids', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|xss_clean');


		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg_error', validation_errors());
				redirect(base_url().'voucher','refresh');
		} else {
				$voucher_wids = array('kode_voucher' 	=> $this->input->post('kode_voucher'),
									  'wids' 			=> $this->input->post('wids'),
									  'telah_ditukar' 	=> '0',
									  'tgl_update' 		=> date('Y-m-d H:i:s'),
									  'keterangan'		=> $this->input->post('keterangan'));

				$this->Mwids->add_voucher_wids($voucher_wids);
				$this->session->set_flashdata('msg_success', 'Vocuher berhasil ditambahkan');
				redirect(base_url().'voucher','refresh');
		}
	}

	function randomString() {
		$length = 10;
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    echo $randomString;
	}


	function beli_voucher(){
		$this->load->view('wids/beli_voucher');
	}

	function beli_wids(){
		$this->form_validation->set_rules('kode_voucher', 'Kode Voucher', 'required|xss_clean|callback_cek_kode_voucher');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg_error', validation_errors());
			redirect(base_url().'buy_voucher','refresh');
		} else {
			$this->session->set_flashdata('msg_success', 'Wids berhasil ditambahkan');
			redirect(base_url().'buy_voucher','refresh');
		}
	}

	function cek_kode_voucher(){
		$voucher = $this->Mwids->cek_kode_voucher($this->input->post('kode_voucher'));
		$users = $this->Users->get_user_by_id($this->session->userdata('nisn'));

		if($voucher){
			$wids = $users->row_array()['wids'] + $voucher->row_array()['wids'];


			$user = array('wids' => $wids);

			$users_wids = array('id_user' 	 => $this->session->userdata('id'),
								'wids' 	  	 => $voucher->row_array()['wids'],
								'action'  	 => 'tambah',
								'keterangan' => 'Pembelian Voucher');

			$voucher_wids = array('telah_ditukar' => 1,
								  'tgl_update'	  => date('Y-m-d H:i:s'));


			$this->Users->update($user, $this->session->userdata('nisn'));

			$this->Muser_wids->transaksi($users_wids);

			$this->Mwids->update_voucher_wids($voucher->row_array()['id'], $voucher_wids);

			$this->session->set_userdata('wids', $this->Users->get_user_by_id($this->session->userdata('nisn'))->row_array()['wids']);

			return True;
		}
		else {
			$this->form_validation->set_message('cek_kode_voucher', 'Kode voucher tidak terdaftar');
			return FALSE;
		}
	}
}

/* End of file Wids.php */
/* Location: ./application/controllers/Wids.php */
