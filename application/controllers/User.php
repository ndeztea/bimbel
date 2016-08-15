<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" AND $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		  $this->load->model('Mpelajaran');
		  $this->load->model('Login');
		$this->load->model('Users');
		$this->load->helper('string');

		
	}


	function data_user(){
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" OR $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		$this->load->view('user/data_user', NULL);
	}

	function user_child(){
		$this->load->view('user/data_user_child');
	}

	function user_list(){
		/*Menagkap semua data yang dikirimkan oleh client*/

		/*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
		server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
		sesuai dengan urutan yang sebenarnya */
		$draw = $_REQUEST['draw'];

		/*Jumlah baris yang akan ditampilkan pada setiap page*/
		$length = $_REQUEST['length'];

		/*Offset yang akan digunakan untuk memberitahu database
		dari baris mana data yang harus ditampilkan untuk masing masing page
		*/
		$start = $_REQUEST['start'];

		/*Keyword yang diketikan oleh user pada field pencarian*/
		$search = $_REQUEST['search']["value"];


		/*Menghitung total desa didalam database*/
		$total=$this->db->count_all_results("users");

		/*Mempersiapkan array tempat kita akan menampung semua data
		yang nantinya akan server kirimkan ke client*/
		$output = array();

		/*Token yang dikrimkan client, akan dikirim balik ke client*/
		$output['draw'] = $draw;

		/*
		$output['recordsTotal'] adalah total data sebelum difilter
		$output['recordsFiltered'] adalah total data ketika difilter
		Biasanya kedua duanya bernilai sama, maka kita assignment 
		keduaduanya dengan nilai dari $total
		*/
		$output['recordsTotal']=$output['recordsFiltered']=$total;

		/*disini nantinya akan memuat data yang akan kita tampilkan 
		pada table client*/
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search != ""){
			$this->db->or_like("nisn", $search);
			$this->db->or_like("nama", $search);
			$this->db->or_like("kelas", $search);
			$this->db->or_like("nama_sekolah", $search);
			$this->db->or_like("nama_level", $search);
		}
		$this->db->select('users.nisn,
						   users.nama,
						   users.kelas,
					       users.nama_sekolah,
					       users.wids,
					       users.is_active,
					       users.level,
					       level.nama_level'); 
		$this->db->from('users');
		$this->db->join('level', 'users.level = level.id_level');

		$this->db->limit($length, $start);
		$this->db->order_by('users.nama','DESC');
		$query=$this->db->get();


		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != ""){
			$this->db->from('users');  
			$this->db->join('level', 'users.level = level.id_level');
			$jum=$this->db->get();
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			if($r['is_active'] == 1):
				$active = " <span class='label label-success'>
         		 			<a href='javascript:;'  onclick=location.href='".base_url()."set_active_user/".$r['nisn']."' style='color:#FFF'>Aktif</a>
      			  			</span>";
			else:
				$active = " <span class='label label-danger'>
         		  			<a href='javascript:;'  onclick=location.href='".base_url()."set_active_user/".$r['nisn']."' style='color:#FFF'>Tidak Aktif</a>
      			  			</span>";
			endif;




			if ($r['level'] == 1){
				$level = " <span class='label label-danger'>
         		 			<a href='javascript:;'  onclick=location.href='".base_url()."set_level_user/".$r['nisn']."' style='color:#FFF'>Superadmin</a>
      			  			</span>";
			}
      		elseif ($r['level'] == 2){
				$level = " <span class='label label-warning'>
         		 			<a href='javascript:;'  onclick=location.href='".base_url()."set_level_user/".$r['nisn']."' style='color:#FFF'>Administrator</a>
      			  			</span>";
      		}
      		elseif ($r['level'] == 3){
				$level = " <span class='label label-info'>
         		 			<a href='javascript:;'  onclick=location.href='".base_url()."set_level_user/".$r['nisn']."' style='color:#FFF'>Reseller</a>
      			  			</span>";
      		}
			else{
				$level = " <span class='label label-success'>
         		  			<a href='javascript:;'  onclick=location.href='".base_url()."set_level_user/".$r['nisn']."' style='color:#FFF'>Member</a>
      			  			</span>";
			}



			$output['data'][]=array($nomor_urut,
									$r['nisn'],
									$r['nama'],
									$r['kelas'],
									$r['nama_sekolah'],
									$r['wids'],
									$active,
									$level,
									"<button class='btn btn-success' onclick=location.href='".base_url()."edit_user/".$r['nisn']."'><i class='fa fa-pencil'></i></button>".
                            		"<button class='btn btn-danger' onclick=confirmDelete(".$r['nisn'].")'><i class='fa fa-trash'></i></button>".
                             		"<button class='btn btn-primary' onclick=location.href='".base_url()."data_wids/".$r['nisn']."'>Wids</button>"
									);
			$nomor_urut++;
		}

		echo json_encode($output);
	}

	function user_child_list(){
		/*Menagkap semua data yang dikirimkan oleh client*/

		/*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
		server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
		sesuai dengan urutan yang sebenarnya */
		$draw = $_REQUEST['draw'];

		/*Jumlah baris yang akan ditampilkan pada setiap page*/
		$length = $_REQUEST['length'];

		/*Offset yang akan digunakan untuk memberitahu database
		dari baris mana data yang harus ditampilkan untuk masing masing page
		*/
		$start = $_REQUEST['start'];

		/*Keyword yang diketikan oleh user pada field pencarian*/
		$search = $_REQUEST['search']["value"];


		/*Menghitung total desa didalam database*/
		$total=$this->db->count_all_results("users");

		/*Mempersiapkan array tempat kita akan menampung semua data
		yang nantinya akan server kirimkan ke client*/
		$output = array();

		/*Token yang dikrimkan client, akan dikirim balik ke client*/
		$output['draw'] = $draw;

		/*
		$output['recordsTotal'] adalah total data sebelum difilter
		$output['recordsFiltered'] adalah total data ketika difilter
		Biasanya kedua duanya bernilai sama, maka kita assignment 
		keduaduanya dengan nilai dari $total
		*/
		$output['recordsTotal']=$output['recordsFiltered']=$total;

		/*disini nantinya akan memuat data yang akan kita tampilkan 
		pada table client*/
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search != ""){
			$this->db->or_like("nisn", $search);
			$this->db->or_like("nama", $search);
			$this->db->or_like("kelas", $search);
			$this->db->or_like("nama_sekolah", $search);
		}
		$this->db->select('users.nisn,
						   users.nama,
						   users.kelas,
					       users.nama_sekolah,
					       users.wids'); 
		$this->db->from('users');
		$this->db->where('user_parent', $this->session->userdata('nisn'));
		$this->db->limit($length, $start);
		$this->db->order_by('users.nama','DESC');
		$query=$this->db->get();


		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != ""){
			$this->db->from('users');  
			$this->db->where('user_parent', $this->session->userdata('nisn'));
			$jum=$this->db->get();
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			
			$output['data'][]=array($nomor_urut,
									$r['nisn'],
									$r['nama'],
									$r['kelas'],
									$r['nama_sekolah'],
									$r['wids']
									);
			$nomor_urut++;
		}

		echo json_encode($output);
	}


	function add_user(){
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|xss_clean');
		$this->form_validation->set_rules('NISN', 'NISN', 'required|xss_clean|callback_cek_nisn');
		$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|xss_clean|matches[password]');
		$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('user/add_user');
		} 
		else {
			if($this->input->post('jkel') == 'l'){
				$photo = 'default-male.png';
			}
			else if($this->input->post('jkel') == 'p'){
				$photo = 'default-female.png';
			}

			$users = array('nisn' 			=> $this->input->post('NISN'),
						   'nama' 			=> $this->input->post('nama_lengkap'),
						   'gender' 		=> $this->input->post('jkel'),
						   'password' 		=> sha1(md5(strrev($this->input->post('password')))),
						   'tingkat_sekolah'=> $this->input->post('pendidikan'),
						   'kelas' 			=> $this->input->post('kelas'),
						   'hp' 			=> $this->input->post('no_hp'),
						   'email' 			=> $this->input->post('email'),
						   'rekening_bank' 	=> $this->input->post('no_rek'),
						   'wids' 			=> "0",
						   'avatar'			=> $photo,
						   'is_active' 		=> '1',
						   'level'			=> '4');

			$this->Users->add($users);
			$this->session->set_flashdata('msg', 'User Berhasil Ditambah');
			redirect(base_url().'users','refresh');
		}
	}


	function delete_user(){
		$id = $this->uri->rsegment(3);
        $this->Users->delete_user($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'user/data_user','refresh');
    }



    function set_active(){
			$get = $this->Users->get_user_by_id($this->uri->rsegment(3));

			if ($get){
				$status = $get->row_array()['is_active'];

				if ($status == 0) {
					$data = array('is_active' => 1);
					$this->session->set_flashdata('msg_success', 'User berhasil diaktifkan');
				}
				else{
					$data = array('is_active' => 0);
					$this->session->set_flashdata('msg_success', 'User berhasil dinon-aktifkan');
				}

				$this->Users->update($data, $get->row_array()['nisn']);
				redirect(base_url().'user/data_user','refresh');

			}
			else{
        		redirect(base_url().'not_found','refresh');
			}
	}

	function set_level(){
		$get = $this->Users->get_user_by_id($this->uri->rsegment(3));

			if ($get){
				$level = $get->row_array()['level'];

				if ($level == "1") {
					$data = array('level' => 2);
					$this->session->set_flashdata('msg_success', 'User '.$get->row_array()['nama'].' berhasil diubah menjadi <b>Admin</b>');
				}
				elseif ($level == "2") {
					$data = array('level' => 3);
					$this->session->set_flashdata('msg_success', 'User '.$get->row_array()['nama'].' berhasil diubah menjadi <b>Reseller</b>');
				}
				elseif ($level == "3") {
					$data = array('level' => 4);
					$this->session->set_flashdata('msg_success', 'User '.$get->row_array()['nama'].' berhasil diubah menjadi <b>Member</b>');
				}
				else{
					$data = array('level' => 1);
					$this->session->set_flashdata('msg_success', 'User '.$get->row_array()['nama'].' berhasil diubah menjadi <b>Superadmin</b>');
				}

				$this->Users->update($data, $get->row_array()['nisn']);
				redirect(base_url().'user/data_user','refresh');

			}
			else{
        		redirect(base_url().'not_found','refresh');
			}
	}




	function edit_user(){
		$users = $this->Users->get_user_by_id($this->uri->rsegment(3));
		

		if($users){

			if($this->input->post('email') != $users->row_array()['email']) {
			   $is_unique =  '|is_unique[users.email]';
			} else {
			   $is_unique =  '';
			}

			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
			$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
			$this->form_validation->set_rules('sekolah', 'Nama Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
			$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email'.$is_unique);
			$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');

			if ($this->form_validation->run() == FALSE) {
				$data['users'] = $users->row_array();
				$this->load->view('user/edit_user', $data);
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
				$data_session['nama'] =  $this->input->post('nama');
				
				update_session($data_session);
				
				$this->Users->update($users, $this->session->userdata('nisn'));
				$this->session->set_flashdata('msg_success', 'Profil Berhasil Diubah');
				redirect(base_url().'user/data_user','refresh');
			}
			
		}
		else{
			redirect(base_url().'404_override','refresh');
		}
	}

	function upload_avatar(){
		$this->session->set_userdata('url_users', base_url()."edit_user/".$this->uri->rsegment(3));
		$users = $this->Users->get_user_by_id($this->uri->rsegment(3))->row_array();

		if($users){

			$config['upload_path'] = 'assets/images/avatar';
	        $config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
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
		                unlink(FCPATH."assets/images/avatar/".$users['avatar']);
		            }
		        $data = array('avatar' => $this->upload->data()['file_name']);
	            $this->Users->update($data, $users['nisn']);
	            redirect($this->session->userdata('url_users'), 'refresh');
	        }
	  	}
	  	else{
	  		redirect(base_url()."not_found",'refresh');
	  	}
	}

	/**
	* update kode daftar dari edit profile
	*
	*/
	function update_kode_daftar(){
		$data['kode_daftar'] = random_string('alnum',10);
		$nisn = $this->session->userdata('nisn');
		if($this->Users->update($data,$nisn)){
			echo $data['kode_daftar'];
			exit;
		}else{
			echo false;
			exit;
		}

		
	}


	function cek_email(){
		$email = $this->input->post('email');
		$get_email = $this->Login->cek_email($email);

		if($get_email){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('cek_email', 'Maaf email yang anda input tidak terdaftar di sistem kami');
			return FALSE;
		}
	}

	function cek_nisn(){
		$nisn = $this->input->post('NISN');

		$cek_nisn = $this->Login->cek_nisn($nisn);

		if($cek_nisn){
			$this->form_validation->set_message('cek_nisn', 'NISN yang kamu masukkan sudah terdaftar, silakan cek kembali NISN kamu.');
			return FALSE;
		}
		else{
			return TRUE;
		}

	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */