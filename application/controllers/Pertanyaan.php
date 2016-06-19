<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mpertanyaan');
	}


	function ajukan_pertanyaan(){
		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg_error', validation_errors());
			$this->load->view('home');
			
		} else {
			$data = array('pertanyaan' => $this->input->post('pertanyaan'),
						  );
			$this->Mpertanyaan->ajukan_pertanyaan($data);
			$this->session->set_flashdata('msg_success', 'Pertanyaan berhasil ditambahkan');
			redirect(base_url().'home','refresh');
		}
	}	
}