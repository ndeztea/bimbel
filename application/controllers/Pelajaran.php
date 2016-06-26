<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelajaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" OR $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		$this->load->model('Mpelajaran');
	}


	function data_pelajaran(){
		$data['data_pelajaran'] = $this->Mpelajaran->getdata()->result();
		$this->load->view('pelajaran/data_pelajaran', $data);
	}


	function tambah_pelajaran(){
		$this->form_validation->set_rules('mata_pelajaran', 'Nama Mata Pelajaran', 'required|xss_clean');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|xss_clean');
		$this->form_validation->set_rules('icon', 'Icon', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg_error', validation_errors());
			$this->load->view('pelajaran/tambah_pelajaran');
			
		} else {
			$data = array('pelajaran' => $this->input->post('mata_pelajaran'),
						  'deskripsi' => $this->input->post('deskripsi'),
						  'params'    => $this->input->post('icon')
						  );
			$this->Mpelajaran->add_pelajaran($data);
			$this->session->set_flashdata('msg_success', 'Data berhasil ditambahkan');
			redirect(base_url().'pelajaran','refresh');
		}
	}	



	function delete_pelajaran(){
		$id = $this->uri->rsegment(3);
        $this->Mpelajaran->delete_pelajaran($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'pelajaran','refresh');
    }



    function edit_pelajaran(){

			$get = $this->Mpelajaran->get_by_id($this->uri->rsegment(3));

			if ($get):

	    		$this->form_validation->set_rules('mata_pelajaran', "Nama Mata Pelajaran", "required|xss_clean");
				$this->form_validation->set_rules('deskripsi', "Deskripsi", 'required|xss_clean');
				$this->form_validation->set_rules('icon', 'Icon', 'required|xss_clean');
			
				if($this->form_validation->run() == FALSE){
					$data['pertanyaan_saya'] = $get->row_array();
					$this->load->view('pelajaran/edit_pelajaran', $data);
				}
				else{
					$data = array('pelajaran' => $this->input->post('mata_pelajaran'),
						  'deskripsi' => $this->input->post('deskripsi'),
						  'params'    => $this->input->post('icon')
						  );
					$this->Mpelajaran->edit_pelajaran($data, $get->row_array()['id']);
					$this->session->set_flashdata('msg_success', 'Data berhasil di update');
					redirect(base_url().'pelajaran','refresh');
				}
			else:
        		redirect(base_url().'not_found','refresh');
			endif;
		}


	function set_active(){
			$get = $this->Mpelajaran->get_by_id($this->uri->rsegment(3));

			if ($get):
				$status = $get->row_array()['is_active'];

				if ($status == 0) {
					$data = array('is_active' => 1);
					$this->session->set_flashdata('msg_success', 'Pelajaran berhasil diaktifkan');
				}
				else{
					$data = array('is_active' => 0);
					$this->session->set_flashdata('msg_success', 'Pelajaran berhasil dinon-aktifkan');
				}

				$this->Mpelajaran->edit_pelajaran($data, $get->row_array()['id']);
				redirect(base_url().'pelajaran','refresh');

			else:
        		redirect(base_url().'not_found','refresh');
			endif;
	}


}
