<?php

	class User extends CI_Model {
		function validate() {
			$this->db->where('email', $this->input->post('email'));
			$this->db->where('password', sha1($this->input->post('password')));
			$query = $this->db->get('Users');
			if ($query->num_rows == 1) {
				return true;
			}
		}

		function create_user() {
			$user_data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'email' => $this->input->post('email'),
				'password' => sha1($this->input->post('password')),
				'role' => 'patron'
			);
			$insert = $this->db->insert('Users', $user_data);
			return $insert;
		}

	}
?>