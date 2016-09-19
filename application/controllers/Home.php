<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}

		$this->load->model('Users');
		$this->load->model('Mpertanyaan');
		$this->load->model('Mpelajaran');
		$this->load->model('Mjawaban');
		$this->load->helper('bimbel_helper');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

	}

	function index()
	{
		$data['pelajaran']		= $this->Mpelajaran->get_first_12();
		$data['pelajaran_more']	= $this->Mpelajaran->get_more();
		$data['pertanyaan']   	= $this->Mpertanyaan->get_pertanyaan(5, 0);
		$this->load->view('home', $data);
	}


	function profil(){
		$users = $this->Users->get_user_by_id($this->session->userdata('nisn'));
		if($users){
			$data['users'] 				= $users->row_array();
			$data['wids']   			= count_wids($users->row_array()['wids']);
	    	$data['pertanyaan_saya']	= $this->Mpertanyaan->get_pertanyaan_by_nisn($this->session->userdata('nisn'), 4, 0);
			$this->load->view('user/profil', $data);
		}
		else{
			redirect(base_url().'404_override','refresh');
		}

	}

	function update_password(){
		$this->form_validation->set_rules('password', 'Password Lama', 'required|xss_clean|callback_cek_password');
		$this->form_validation->set_rules('new_password', 'Password Baru', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|xss_clean|matches[new_password]');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('user/update_password');
		} else {
			$data = array('password' => sha1(md5(strrev($this->input->post('confirm_password')))));
			$this->Users->update($data, $this->session->userdata('nisn'));
			$this->session->set_flashdata('msg_success', 'Password Berhasil Diubah');
			redirect(base_url().'profil','refresh');
		}
	}

	function update_profil(){
		$users = $this->Users->get_user_by_id($this->session->userdata('nisn'));

		if($users){

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

				// update session
				$data_session['nama'] =  $this->input->post('nama');
				$data_session['gender'] =  $this->input->post('jkel');
				$data_session['pendidikan'] =  $this->input->post('pendidikan');
				$data_session['kelas'] =  $this->input->post('kelas');
				update_session($data_session);

				$this->Users->update($users, $this->session->userdata('nisn'));
				$this->session->set_flashdata('msg_success', 'Profil Berhasil Diubah');
				redirect(base_url().'profil','refresh');
			}
		}
		else{
			redirect(base_url().'404_override','refresh');
		}
	}

	function upload_avatar(){
		$config['upload_path'] = 'assets/images/avatar';
        $config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
        $config['max_size'] = '5000';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar')){
            $this->session->set_flashdata('msg_error', $this->upload->display_errors());
            redirect(base_url().'profil', 'refresh');
        }
        else{
            $this->session->set_userdata('error', "");
            $this->session->set_flashdata('msg_success', 'Photo profil berhasil diubah');
	            if($this->session->userdata('avatar') AND $this->session->userdata('avatar') != "default-male.png" AND $this->session->userdata('avatar') != "default-female.png"){
	                unlink(FCPATH."assets/images/avatar/".$this->session->userdata('avatar'));
	            }
	        $data = array('avatar' => $this->upload->data()['file_name']);
            $this->Users->update($data, $this->session->userdata('nisn'));
            $this->session->set_userdata('avatar', $this->upload->data()['file_name']);
            redirect(base_url().'profil', 'refresh');
        }
	}

	function cek_password(){
		$password = $this->Users->cek_password($this->session->userdata('nisn'), sha1(md5(strrev($this->input->post('password')))));

		if($password){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('cek_password', 'Password yang anda masukkan salah, data gagal diubah');
			return FALSE;
		}
	}


	function load_more(){
		$get = $this->Mpertanyaan->get_pertanyaan(5, $this->input->post('offset'));
		if($get->num_rows() >= 1){
			foreach ($get->result() as $r) {
				echo "<div class='box-comment'> 
		            			<img class='img-circle img-sm' src='".
		            			base_url('assets/images/avatar')."/".$r->avatar_penanya."'>
		            			<div class='comment-text'>
		            				<span class='username'>"
		            					.$r->nama_pelajaran."&middot;"
						         	 	.get_tingkat($r->tingkat).
						         	 	'<span class="text-muted pull-right">'.lapse_time(strtotime($r->tgl_update)).'</span>'.
		            				"</span>
		            				<a href='".base_url()."detail_pertanyaan/".$r->id_pertanyaan."'>".$r->pertanyaan."</a>
	          						<button class='btn btn-success btn-xs pull-right' onclick=location.href='".base_url()."detail_pertanyaan/".$r->id_pertanyaan."'><i class='fa fa-share'></i> Jawab</button>
		            			</div>
						    </div>";
			}
		}
		else{
			echo "Tidak ada data lagi";
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */