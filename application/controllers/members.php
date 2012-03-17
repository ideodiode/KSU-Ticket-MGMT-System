<?php
class Members extends CI_Controller {
	function index() {
		$this->load->view('includes/header');
		$this->load->view('userPage');
		$this->load->view('includes/footer');
	}

}
?>