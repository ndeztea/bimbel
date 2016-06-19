<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}

		$this->load->model('users');
	}

	function index()
	{
		$this->load->view('home');
	}


	function profil(){
		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));
		if($users):
			$data['users'] = $users->row_array();
			$data['wids'] = $this->count_wids($this->session->userdata('nisn'));
			$this->load->view('user/profil', $data);
		else:
			redirect(base_url().'404_override','refresh');
		endif; 

	}

	function update_profil(){
		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));
		if($users):
			$data['users'] = $users->row_array();
			$this->load->view('user/edit_profil', $data);
		else:
			redirect(base_url().'404_override','refresh');
		endif; 
	}

	function upload_avatar(){
		$config['upload_path'] = 'assets/images/avatar';
        $config['allowed_types'] = 'jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar')):
            $this->session->set_flashdata('msg_error', $this->upload->display_errors());
            redirect(base_url().'profil', 'refresh');
        else:
            $this->session->set_userdata('error', "");
            $this->session->set_flashdata('msg_success', 'Photo profil berhasil diubah');
	            if(($this->session->userdata('avatar'))){
	                unlink(FCPATH . "assets/images/avatar/".$this->session->userdata('avatar'));
	            }
            $this->users->upload_avatar($this->upload->data()['file_name'], $this->session->userdata('nisn'));
            $this->session->set_userdata('avatar', $this->upload->data()['file_name']);
            redirect(base_url().'profil', 'refresh');
        endif;
	}

	function count_wids($id){
		$users = $this->users->get_user_by_id($id)->row_array()['wids'];

		if($users == 0 AND $users < 10){
			$wids = "Pemula";
		}
		elseif($users >= 10 AND $users < 30){
			$wids = "Ambis";
		}
		elseif ($users >= 30 AND $users < 50) {
			$wids = "Prestisius";
		}
		elseif ($users >= 50 AND $users < 100) {
			$wids = "Prestisius";
		}
		elseif ($users >= 100 AND $users < 200) {
			$wids = "Ahli";
		}
		elseif ($users >= 200 AND $users < 500) {
			$wids = "Sangat Ahli";
		}
		elseif ($users >= 500 AND $users < 1000) {
			$wids = "Jenius";
		}
		elseif ($users >= 1000) {
			$wids = "Super Jenius";
		}

		return $wids;
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */