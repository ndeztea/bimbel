<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mpertanyaan');
		$this->load->model('Mjawaban');
		$this->load->helper('bimbel_helper');
	}


	function data_pertanyaan(){
		$data['data_pertanyaan'] = $this->Mpertanyaan->get_pertanyaan()->result();
		$this->load->view('Pertanyaan/data_pertanyaan', $data);
	}

	function pertanyaan_saya(){
		$data['pertanyaan'] = $this->Mpertanyaan->get_pertanyaan_by_nisn($this->session->userdata('nisn'), 10, 0);
		$data['no'] = 1;
		$this->load->view('pertanyaan/data_pertanyaan_saya', $data);
	}



	function delete_pertanyaan(){
		$id = $this->uri->rsegment(3);
        $this->Mpertanyaan->delete_pertanyaan($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'data_pertanyaan','refresh');
    }

    function detail_pertanyaan(){
    	$pertanyaan = $this->Mpertanyaan->get_detail_pertanyaan($this->uri->rsegment(3));


    	if($pertanyaan):
			$data['pertanyaan'] = $pertanyaan->row_array();
			$data['jawaban_pertanyaan'] = $this->Mjawaban->get_jawaban_pertanyaan($this->uri->rsegment(3));
			$data['wids_penanya'] = count_wids($data['pertanyaan']['wids_penanya']);
			$this->load->view('Pertanyaan/detail_pertanyaan', $data);
		else:
			$this->load->view('404');
		endif;

    }


    function delete_pertanyaan_saya(){
		$id = $this->uri->rsegment(3);
        $this->Mpertanyaan->delete_pertanyaan($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'my_question','refresh');
    }


    function edit_pertanyaan_saya(){	
		$get = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));

			if ($get):

	    		$this->form_validation->set_rules('pertanyaan', "Pertanyaan", "required|xss_clean");
				$this->form_validation->set_rules('tingkatan', "tingkatan", 'required|xss_clean');
				$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|xss_clean');
				$this->form_validation->set_rules('wids', 'Wids', 'required|xss_clean');

			
				if($this->form_validation->run() == FALSE){
					$data['data'] = $get->row_array();
					$this->load->view('pertanyaan/edit_pertanyaan_saya', $data);
				}
				else{
					$data = array('pertanyaan'		  => $this->input->post('pertanyaan'),
						  		  'tingkatan'		  => $this->input->post('tingkatan'),
						  		  'mata_pelajaran'    => $this->input->post('mata_pelajaran'),
						  		  'wids'   			  => $this->input->post('wids')
						  );
					$this->Mpertanyaan->edit_pertanyaan_saya($data, $get->row_array()['id']);
					$this->session->set_flashdata('msg_success', 'Data berhasil di update');
					redirect(base_url().'pertanyaan','refresh');
				}
			else:
        		redirect(base_url().'not_found','refresh');
			endif;
		}
}