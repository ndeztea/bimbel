<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}
		$this->load->model('mjawaban');
		$this->load->helper('bimbel_helper');
	}


	function delete_jawaban(){
		$jawaban = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

		if($jawaban):
			if($jawaban->row_array()['photo'] != NULL)
    		{
				unlink(FCPATH."assets/images/answer/".$jawaban->row_array()['photo']);
			}
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
        $result_content = $content->row_array();
        $count_wids_array  = array('count_wids' => count_wids($result_content['wids_penjawab']));

        echo json_encode(array_merge($result_content, $count_wids_array));
    }


    function edit_jawaban(){
    	$get = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

			if ($get):

	    		$this->form_validation->set_rules('jawaban', "Jawaban", "required|xss_clean");
			
				if($this->form_validation->run() == FALSE){
					$data['edit_jawaban'] = $get->row_array();
					$this->load->view('jawaban/edit_jawaban', $data);
				}
				else{
					$data = array('jawaban' => $this->input->post('jawaban')
						  );
					$this->mjawaban->edit_jawaban($data, $get->row_array()['id']);
					$this->session->set_flashdata('msg_success', 'Data berhasil di update');
					redirect($this->session->userdata('url_pertanyaan'),'refresh');
				}
			else:
        		redirect(base_url().'not_found','refresh');
			endif;
		}

	function tambah_gambar_jawaban(){
		$jawaban = $this->mjawaban->get_jawaban_by_id($this->input->post('id'));

		if($jawaban):
			if($jawaban->row_array()['photo'] != NULL)
    		{
				unlink(FCPATH."assets/images/answer/".$jawaban->row_array()['photo']);
			}
		endif;


		$config['upload_path'] = 'assets/images/answer';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1024';
		$config['encrypt_name'] = true;
		
		$this->load->library('upload', $config);
		
		if ( !$this->upload->do_upload('gambar-jawaban')){
			$error = array('error' => $this->upload->display_errors());
			echo json_encode(array('html' => $error['error']));
		}
		else{
			$data = array('photo' => $this->upload->data()['file_name']);

			$this->mjawaban->edit_jawaban($data, $this->input->post('id'));
			echo json_encode($data);
		}
	}
}

/* End of file Jawaban.php */
/* Location: ./application/controllers/Jawaban.php */