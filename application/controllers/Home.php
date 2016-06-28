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
		$this->load->model('mpertanyaan');
		$this->load->model('mpelajaran');
		$this->load->model('mjawaban');
		$this->load->helper('bimbel_helper');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

	}

	function index()
	{
		$data['pertanyaan']   		= $this->mpertanyaan->get_pertanyaan(5, 0);
		$this->load->view('home', $data);
	}


	function profil(){
		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));
		if($users):

			$data['users'] 				= $users->row_array();
			$data['wids']   			= count_wids($users->row_array()['wids']);
	    	$data['pertanyaan_saya']	= $this->mpertanyaan->get_pertanyaan_by_nisn($this->session->userdata('nisn'), 4, 0);
			$this->load->view('user/profil', $data);
		else:
			redirect(base_url().'404_override','refresh');
		endif; 

	}

	function update_profil(){
		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));
		

		if($users):

			if($this->input->post('email') != $users->row_array()['email']) {
			   $is_unique =  '|is_unique[users.email]';
			} else {
			   $is_unique =  '';
			}


			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|callback_cek_password');
			$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
			$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
			$this->form_validation->set_rules('sekolah', 'Nama Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
			$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email'.$is_unique);
			$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');

			if ($this->form_validation->run() == FALSE) {
				$data['users'] = $users->row_array();
				$this->load->view('user/edit_profil', $data);
			} else {
				$users = array('nama' 			=> $this->input->post('nama'),
							   'gender' 		=> $this->input->post('jkel'),
							   'tingkat_sekolah'=> $this->input->post('pendidikan'),
							   'kelas' 			=> $this->input->post('kelas'),
							   'nama_sekolah' 	=> $this->input->post('sekolah'),
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
	            if(($this->session->userdata('avatar')) AND $this->session->userdata('avatar') != "default.jpg"){
	                unlink(FCPATH."assets/images/avatar/".$this->session->userdata('avatar'));
	            }
	        $data = array('avatar' => $this->upload->data()['file_name']);
            $this->users->update($data, $this->session->userdata('nisn'));
            $this->session->set_userdata('avatar', $this->upload->data()['file_name']);
            redirect(base_url().'profil', 'refresh');
        endif;
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

	function load_more(){
		$get = $this->mpertanyaan->get_pertanyaan(5, $this->input->post('offset'));
		if($get->num_rows() > 1):
			foreach ($get->result() as $r) {
				echo "<div class='box-comment'> 
		            			<img class='img-circle img-sm' src='".
		            			base_url('assets/images/avatar')."/".$r->avatar_penanya."'>
		            			<div class='comment-text'>
		            				<span class='username'>"
		            					.$r->nama_pelajaran."&middot;"
						         	 	.$r->wids_pertanyaan."Wids &middot;"
						         	 	.get_tingkat($r->tingkat).
		            				"</span>
		            				<a href='".base_url()."detail_pertanyaan/".$r->id_pertanyaan."'>".$r->pertanyaan."</a>
	          						<button class='btn btn-success btn-xs pull-right' onclick=location.href='".base_url()."detail_pertanyaan/".$r->id_pertanyaan."'><i class='fa fa-share'></i> Jawab</button>
		            			</div>
						    </div>";
			}
		else:
			echo "Tidak ada data lagi";
		endif;
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */