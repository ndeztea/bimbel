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
		$this->load->model('Mpertanyaan');
		$this->load->model('Mpelajaran');
		$this->load->model('Mjawaban');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

	}

	function index()
	{		
		$data['pertanyaan']   = $this->Mpertanyaan->get_pertanyaan();
		$data['pelajaran'] 	  = $this->Mpelajaran->getdata()->result();
		$data['wids'] 		  = $this->count_wids($this->session->userdata('nisn'));
		$this->load->view('home', $data);
	}


	function profil(){
		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));
		if($users):
			$data['users'] 				= $users->row_array();
			$data['wids']   			= $this->count_wids($this->session->userdata('nisn'));
	    	$data['jawaban']			= $this->Mjawaban->get_jawaban_by_nisn('nisn');
	    	$data['pertanyaan_saya']	= $this->Mpertanyaan->get_pertanyaan_by_nisn($this->session->userdata('nisn'), 4, 0);

			$this->load->view('user/profil', $data);
		else:
			redirect(base_url().'404_override','refresh');
		endif; 

	}

	function update_profil(){
		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));
		

		if($users):

			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|callback_cek_password');
			$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
			$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
			$this->form_validation->set_rules('sekolah', 'Nama Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
			$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email');
			$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');

			if ($this->form_validation->run() == FALSE) {
				$data['users'] = $users->row_array();
				$this->load->view('user/edit_profil', $data);
			} else {
				$users = array('nama' 			=> $this->input->post('nama'),
							   'gender' 		=> $this->input->post('jkel'),
							   'tingkat_sekolah'=> $this->input->post('pendidikan'),
							   'kelas' 			=> $this->input->post('kelas'),
							   'nama_sekolah' 		=> $this->input->post('sekolah'),
							   'hp' 			=> $this->input->post('no_hp'),
							   'email' 			=> $this->input->post('email'),
							   'rekening_bank' 	=> $this->input->post('no_rek'));

				$this->users->update($users, $this->session->userdata('nisn'));
				$this->session->set_flashdata('msg_success', 'Profil Berhasil Diubah');
				$this->session->set_userdata($this->input->post('nama'));
				redirect(base_url().'profil','refresh');
			}
			
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
	        $data = array('avatar' => $this->upload->data()['file_name']);
            $this->users->update($data, $this->session->userdata('nisn'));
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

	function cek_password(){
		$password = $this->users->cek_password($this->session->userdata('nisn'), sha1(md5(strrev($this->input->post('password')))));

		if($password){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('cek_password', 'Password yang anda masukkan salah, data gagal diubah');
			return FALSE;
		}
	}



	function add_pertanyaan(){
		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|xss_clean');
		$this->form_validation->set_rules('tingkat', 'Tingkat', 'required|xss_clean');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|xss_clean');
		$this->form_validation->set_rules('wids', 'Wids', 'required|xss_clean');



		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg_error', validation_errors());
			$this->load->view('home');
			
		} else {
			$data = array('id_pelajaran' => $this->input->post('mata_pelajaran'),
						  'tingkat'  	 => $this->input->post('tingkat'),
						  'pertanyaan' 	 => $this->input->post('pertanyaan'),
						  'wids'  		 => $this->input->post('wids'),	
						  'id_user' 	 => $this->session->userdata('id'),
						  'tgl_update'   => date("Y-m-d H:i:s")						  
						  );
			$this->Mpertanyaan->add_pertanyaan($data);
			$this->session->set_flashdata('msg_success', 'Pertanyaan berhasil ditambahkan');
			redirect(base_url().'home','refresh');
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */