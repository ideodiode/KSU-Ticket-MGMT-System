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

		function update($key, $id, $field, $value){
			$this->db->where($key, $id);
			$this->db->update('Users', array($field=>$value));
		}
		
		function validate($email, $password) {
			$this->db->where('email', $email);
			$this->db->where('password', sha1($password));
			$this->db->where('authenticated', '1');
			// Has the user authenticated their email?
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
			$this->db->select('firstName, lastName, phone, email, role, user_id')->from('Users')->where('email', $email)->limit(1);
			return $this->db->get()->row();
		}

		function get_info_from_id($id) {
			$q = $this->db->select('email')->from('Users')->where('user_id', $id)->limit(1);
			$email = $this->db->get()->row()->email;
			return $this->get_info($email);
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
			if ($select_user==NULL){
				//count total results of query
				$q = $this->db->select('COUNT(*) as count', FALSE)
					->from('Users');
				$tmp = $q->get()->result();
				
				//return subset of full query for pagination
				$q = $this->db->select('user_id, firstName, lastName, email, phone, role')
					->from('Users')
					->limit($limit, $offset)
					->order_by($sort_by, $sort_order);
				$ret['rows'] = $q->get()->result();
			}
			else{
				//count total results of query
				$q = $this->db->select('COUNT(*) as count', FALSE)
					->from('Users')
					->where('user_id', $select_user);
				$tmp = $q->get()->result();
				
				//return subset of full query for pagination
				$q = $this->db->select('user_id, firstName, lastName, email, phone, role')
					->from('Users')
					->where('user_id', $select_user)
					->limit($limit, $offset)
					->order_by($sort_by, $sort_order);
				$ret['rows'] = $q->get()->result();
			}
			$ret['num_rows'] = $tmp[0]->count;
			
			return $ret;
		}

		function get_roles() {
			$roles = array(
				'patron' => 'Patron',
				'tech' => 'Tech',
				'admin' => 'Admin');
			return $roles;
		}
		
		function get_techs() {
			$q = $this->db->select('user_id, firstName, lastName')
			->from('Users')
			->where('role', 'tech');
			foreach ($q->get()->result() as $row){
				$techs[$row->user_id] = $row->firstName. " " .$row->lastName;
			}
			return $techs;
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

		function editable_fields($role){
			if ($role == 'admin'){
				$fields = array(
					'user_id' => FALSE,
					'firstName' => TRUE,
					'lastName' => TRUE,
					'email' => TRUE,
					'phone' => FALSE,
					'role' => TRUE
				);
			}else {
				$fields = array(
					'user_id' => FALSE,
					'firstName' => FALSE,
					'lastName' => FALSE,
					'email' => FALSE,
					'phone' => TRUE,
					'role' => FALSE
				);
			}
			return $fields;
		}
	}
?>