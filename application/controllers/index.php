<?php

	class Main extends CI_Controller {
		function index() {
			$data = array(
				'main_content' => 'main',
				'title' => 'Service Center'
			);
			$this->load->view('includes/template', $data);
			$session = $this->session->all_userdata();
			//print_r($session);
			if($session['logged_in']) {
				echo 'yay!';
			}

		}

	}
