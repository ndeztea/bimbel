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
				$data['msg_error'] =  validation_errors();
				$this->load->view('reseller/add_reseller',$data);
				//$this->session->set_flashdata('msg_error', validation_errors());

		} else {
				$data = array('nama' => $this->input->post('nama'),
							  'alamat' => $this->input->post('alamat'),
							  'no_hp' => $this->input->post('no_hp'),
							  'id_user' => $this->session->userdata('id'));

				$this->Mreseller->add($data);
				$this->session->set_flashdata('msg_success', 'Kamu berhasil diajukan menjadi reseller');
				redirect(base_url().'add_reseller','refresh');
		}
	}

	function delete_reseller(){
		$reseller = $this->Mreseller->get_by_id($this->uri->rsegment(3));

		if($reseller){
			$this->Mreseller->delete($this->uri->rsegment(3));
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
			redirect(base_url().'data_reseller','refresh');

		}
		else{
			redirect(base_url().'not_found','refresh');
		}
	}


	function set_active_reseller(){
		$get = $this->Mreseller->get_by_id($this->uri->rsegment(3));

			if ($get){
				$status = $get->row_array()['is_approved'];

				if ($status == 0) {
					$data = array('is_approved' => "1");
					$user = array('level' => "3");
					$this->session->set_flashdata('msg_success', 'Reseller berhasil diaktifkan');
				}
				else{
					$data = array('is_approved' => "0");
					$user = array('level' => "4");
					$this->session->set_flashdata('msg_success', 'Reseller berhasil dinon-aktifkan');
				}

				$this->Mreseller->update($data, $get->row_array()['id']);
				$this->Users->update_by_id($user, $get->row_array()['id_user']);
				redirect(base_url().'data_reseller','refresh');

			}else{
        		redirect(base_url().'not_found','refresh');
			}
	}
	

	function cari_reseller(){
		  $search = strip_tags(trim($this->input->get('q')));
	      $query = $this->Mreseller->search_reseller($search);

          
          if($query->num_rows() > 0){
		        foreach ($query->result() as $r) {
	            $data[] = array('id' => $r->id,
	                          	'text' =>$r->nama."(".$r->nisn.")");   
	          }
	      }
	      else {
	        $data[] = array('id' => '-99',
	                      	'text'=>'Reseller Tidak Ditemukan');
	      }
	      echo json_encode($data);
	}
}

/* End of file Reseller.php */
/* Location: ./application/controllers/Reseller.php */