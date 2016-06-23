<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mjawaban');
	}


	function delete_jawaban(){
		$jawaban = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

		if($jawaban):
			$this->mjawaban->hapus_jawaban($this->uri->rsegment(3));
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
			redirect($this->session->userdata('url_pertanyaan'),'refresh');
		else:
			redirect(base_url().'not_found','refresh');
		endif;
	}


	function insert_jawaban() {
 
       	$jawaban = array('jawaban' => $this->input->post('jawaban'),
       					 'id_pertanyaan' => $this->input->post('id_pertanyaan'),
       					 'id_user' => $this->session->userdata('id'),
       					  );
 	
        $this->mjawaban->insert_jawaban($jawaban);

        $content = $this->mjawaban->get_last_jawaban($jawaban['id_pertanyaan']);
        echo json_encode($content->row_array());
    }


    function edit_jawaban(){

			$get = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

			if ($get):

	    		$this->form_validation->set_rules('jawaban', "Jawaban", "required|xss_clean");
			
				if($this->form_validation->run() == FALSE){
					$data['jawaban'] = $get->row_array();
					$this->load->view('jawaban/edit_jawaban', $data);
				}
				else{
					$data = array('pelajaran' => $this->input->post('jawaban')
						  );
					$this->mjawaban->edit_jawaban($data, $get->row_array()['id']);
					$this->session->set_flashdata('msg_success', 'Data berhasil di update');
					redirect(base_url().'pertanyaan/detail_pertanyaan','refresh');
				}
			else:
        		redirect(base_url().'not_found','refresh');
			endif;
		}

}

/* End of file Jawaban.php */
/* Location: ./application/controllers/Jawaban.php */