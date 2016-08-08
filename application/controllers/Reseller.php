<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reseller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpelajaran');
		$this->load->model('Mreseller');
		$this->load->model('Users');
		$this->load->model('Mpertanyaan');
		$this->load->model('Mjawaban');
	}

	function all_reseller()
	{
		$data['no'] = 1;
		$data['reseller'] = $this->Mreseller->get_all();
		$this->load->view('reseller/data_reseller', $data);
	}

	function add_reseller(){
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
				$this->load->view('reseller/add_reseller');
				$this->session->set_flashdata('msg_error', validation_errors());

		} else {
				$data = array('nama' => $this->input->post('nama'),
							  'alamat' => $this->input->post('alamat'),
							  'no_hp' => $this->input->post('no_hp'),
							  'id_user' => $this->session->userdata('id_user'));

				$this->Mreseller->add($data);
				$this->session->set_flashdata('msg_success', 'Data berhasil ditambah');
				redirect(base_url().'data_reseller','refresh');
		}
	}

}

/* End of file Reseller.php */
/* Location: ./application/controllers/Reseller.php */