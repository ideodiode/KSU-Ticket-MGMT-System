<?php

class User_model extends CI_Model {
	function validate($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('password', sha1($$password));
		$query = $this->db->get('Users');
		if ($query->num_rows == 1) {
			return true;
		}
	}

	function create_user($firstName, $lastName, $email, $password, $authCode) {
		$user_data = array(
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
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

}
?>