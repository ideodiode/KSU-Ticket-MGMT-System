<?php

class Faq extends CI_Controller {
	function index() {
		$this->load->model('faq_model');
		$faqs = $this->faq_model->get_faqs();
		$data = array(
			'main_content' => 'faq',
			'faqs' => $faqs
		);
		$this->load->view('includes/template', $data);
	}

}
