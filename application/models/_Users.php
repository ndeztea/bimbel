<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {


	// List all your items
	function get_all_users($keyword=NULL,$limit=NULL,$offset=NULL,$param_query=NULL){
		$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
        $this->db->from('users');

        // Keyword By
        if ($keyword!=NULL) {
            if (is_array($param_query['keyword_by'])) {
                $this->db->or_like($param_query['keyword_by']);
            } else{
                $this->db->or_like($param_query['keyword_by'],$keyword);
            }
        }

        $this->db->limit($limit,$offset);
        $this->db->order_by($param_query['sort'],$param_query['sort_order']);
        
        $query = $this->db->get();
        $result['data']     = $query->result_array();
        $result['count']    = $query->num_rows();
        $result['count_all']= $this->db->query('SELECT FOUND_ROWS() as count')->row()->count;


        if($query->num_rows() > 0){ return $result; } else { return FALSE; }
	}

	function get_user_by_id($id){
		$this->db->where('nisn', $id);
		$return = $this->db->get('users');

		if($return->num_rows() > 0 and $return->num_rows() == 1):
			return $return;
		else:
			return FALSE;
		endif;

	}

	// Add a new item
	function add($data)
	{
		$this->db->insert('users', $data);
	}

	//Update one item
	function update($data, $id)
	{

	}

	//Delete one item
	function delete($id)
	{

	}


	function upload_avatar($filename, $id_user){
		$users = array('avatar' => $filename);

		$this->db->where('nisn', $id_user);
		$this->db->update('users', $users);
	}
}

/* End of file users.php */
/* Location: ./application/models/users.php */
