<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mwids extends CI_Model {

	
	function get_wids($id){
			$this->db->select('users_wids.* , users.id, users.nama');
			$this->db->from('users_wids');
			$this->db->join('users', 'users_wids.id_user = users.id');
			$this->db->where('users.nisn', $id);
			$this->db->order_by('tgl_update', 'desc');
			return $this->db->get();
	}


	function data_voucher($limit = NULL, $offset = NULL, $search = NULL, $status = NULL){
		if($search != NULL){
			$this->db->like('kode_voucher', $search);
		}
		if($status != NULL){
			$this->db->where('telah_ditukar', $status);
		}

		return $this->db->get('vouchers_wids', $limit, $offset);
	}

	function get_voucher_wids(){
		return $this->db->get('vouchers_wids');
	}


	function get_voucher_wids_reseller(){
		$this->db->where('peruntukan', $this->session->userdata('id'));
		return $this->db->get('vouchers_wids');
	}

	function get_request_wids(){
		$this->db->select('tukar_wids.* ,  users.nama');
		$this->db->from('tukar_wids');
		$this->db->join('users', 'tukar_wids.id_user = users.id');
		$this->db->order_by('tgl_update', 'desc');
		return $this->db->get();
	}

	function update_request_wids($data,$id){
		$this->db->where('id', $id);
		return $this->db->update('tukar_wids', $data);
	}

	function delete_request_wids($id){
		$this->db->where('id', $id);
		return $this->db->delete('tukar_wids');
	}

	function delete_voucher_wids($id){
		$this->db->where('id', $id);
		return $this->db->delete('vouchers_wids');
	}

	function get_jawaban_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('users_wids');

		if($query){
			return $query;
		}
		else{
			return false;
		}
	}

	function add_wids($data, $user){
		$this->db->where('id', $user['id']);
		$this->db->update('users', $user);
		$this->db->insert('users_wids', $data);
	}

	function add_sell($data){
		return $this->db->insert('tukar_wids', $data);
	}

	function add_voucher_wids($data){
		$this->db->insert('vouchers_wids', $data);
	}

	function cek_kode_voucher($id){
		$this->db->where('kode_voucher', $id);
		$this->db->where('telah_ditukar', 0);
		$return = $this->db->get('vouchers_wids');

		if($return->num_rows() > 0){
			return $return;
		}
		else{
			return false;
		}
	}

	function update_voucher_wids($id, $data){
		$this->db->where('id', $id);
		$this->db->update('vouchers_wids', $data);
	}
}

/* End of file Mwids.php */
/* Location: ./application/models/Mwids.php */