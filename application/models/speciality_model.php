<?php

	class speciality_model extends CI_Model {
		function get_specialities() {
			$results = $this->db->select('name, desc, speciality_id')->from('speciality')->get()->result();
			return $results;
		}

		function add_speciality($name, $desc) {
			$data = array(
				'name' => $name,
				'desc' => $desc,
			);
			return $this->db->insert('speciality', $data);
		}

		function delete_speciality($id) {
			return $this->db->delete('speciality', array('speciality_id' => $id));
		}

	}
