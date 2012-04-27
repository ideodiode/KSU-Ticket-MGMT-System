<?php
class Faq_Model extends CI_Model {
	function insert_question($question, $answer) {
		$this->load->database();
		$data = array(
			'question' => $question,
			'answer' => $answer
		);
		$this->db->insert('faq', $data);
	}

	function get_faqs() {
		// Generate FAQ

		$faqs = $this->db->select('id, question, answer')->from('faq')->get()->result();
		return $faqs;
	}

	function delete_question($id) {
		//$this->db->query('DELETE FROM faq WHERE id ='.$id);
		$this->db->delete('faq', array('id' => $id));
	}

}
?>
