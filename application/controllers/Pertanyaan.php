<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mpertanyaan');
	}


	function data_pertanyaan(){
		$data['data_pertanyaan'] = $this->Mpertanyaan->get_pertanyaan()->result();
		$this->load->view('Pertanyaan/data_pertanyaan', $data);
	}



	function delete_pertanyaan(){
		$id = $this->uri->rsegment(3);
        $this->Mpertanyaan->delete_pertanyaan($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'data_pertanyaan','refresh');
    }


}