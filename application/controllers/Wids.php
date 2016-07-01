<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wids extends CI_Controller {


	function __construct()
	{
		
		parent::__construct();
		$this->load->model('mwids');
		$this->load->model('users');
	}


	function data_wids()	{
		$data['wids'] = $this->mwids->get_wids($this->uri->rsegment(3));
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
			$user = $this->users->get_user_by_id($this->uri->rsegment(3))->row_array();
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
							  'wids'	=> $wids,
							  'action'  => $this->input->post('aksi'),
							  'keterangan' => $this->input->post('keterangan'));

				$this->mwids->add_wids($data, $users);
				$this->session->set_flashdata('msg_success', 'Wids berhasil di'.$this->input->post('aksi'));
				redirect(base_url().'data_wids/'.$this->uri->rsegment(3) , 'refresh');
			}
			else {
				redirect(base_url().'users','refresh');
			}
				
		}
	}

}

/* End of file Wids.php */
/* Location: ./application/controllers/Wids.php */
