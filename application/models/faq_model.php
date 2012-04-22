<?php
class Faq_Model extends CI_Model
{
	function insert_question()
	{
		$this->load->database();
		$data = array(
				'question' => $this->input->post('question'),
				'answer' => $this->input->post('answer'));
				
		$this->db->insert('faq', $data); 
	}
}
?>
	