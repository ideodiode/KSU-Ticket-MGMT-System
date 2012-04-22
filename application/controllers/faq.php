<?php

class Faq extends CI_Controller 
{
	
	function add_question() 
	{	
		$this->load->helper(array('form', 'url'));
		echo "success";

		$this->load->library('form_validation');
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('faq_form');
		}
		else
		{
			$this->load->model('faq_model');
			$this->faq_model->insert_question();
			$this->load->view('faq_form');
		}
	}	
	
}

?>