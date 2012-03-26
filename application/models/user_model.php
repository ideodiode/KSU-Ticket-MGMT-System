<?php

class User_model extends CI_Model {
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

}
?>