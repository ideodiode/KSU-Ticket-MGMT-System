<?php

class User_model extends CI_Model {

	function get_role($email) {
		$q = $this->db->select('role')->from('Users')->where('email', $email)->limit(1);
		$row = $q->get()->row();
		return $row->role;
	}
	
	function get_id($email) {
		$q = $this->db->select('user_id')->from('Users')->where('email', $email)->limit(1);
		$row = $q->get()->row();
		return $row->user_id;
	}

	function validate($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('password', sha1($password));
		$query = $this->db->get('Users');
		if ($query->num_rows == 1) {
			return true;
		}
	}

	function create_user($firstName, $lastName, $email, $phone, $password, $authCode) {
		$user_data = array(
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
			'phone' => $phone,
			'password' => sha1($password),
			'role' => 'patron',
			'auth_key' => $authCode
		);
		$insert = $this->db->insert('Users', $user_data);
		return $insert;
	}

	function activate_user($authKey) {
		$sql = "UPDATE Users SET authenticated = 1 WHERE auth_key = ?";
		return $this->db->query($sql, array($authKey));

	}

	function get_info($email) {
		$this->db->select('firstName, lastName, phone, email')->from('Users')->where('email', $email)->limit(1);
		return $this->db->get()->row();
	}

	function update_user($email, $firstName, $lastName, $phone) {
		$user_data = array(
			'firstName' => $firstName,
			'lastName' => $lastName,
			'phone' => $phone
		);
		$this->db->where('email', $email);
		return $this->db->update('Users', $user_data);
	}
	
	//Search used by Tablebuilder class to pull data for paginated tables
	function search($limit, $offset, $sort_by, $sort_order, $select_user) {		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		
		$sort_columns = array('user_id', 'firstName', 'lastName', 'email', 'phone', 'role');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ID';
		
		// results query
		if ($select_user==NULL)
		$q = $this->db->select('user_id, firstName, lastName, email, phone, role')
			->from('Users')
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		else
			$q = $this->db->select('user_id, firstName, lastName, email, phone, role')
			->from('Users')
			->where('user_id', $select_user)
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('Users');
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function display_fields() {
		$fields = array(
			'user_id' => 'ID',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'email' => 'email',
			'phone' => 'Phone #',
			'role' => 'Role'
		);
		return $fields;
	}

}
?>