<?php

	class User extends CI_Controller {
		function index() {
			$data = array(
				'main_content' => 'userPage',
				'title' => 'User Page'
			);
			$this->load->view('includes/template', $data);
		}

	}
