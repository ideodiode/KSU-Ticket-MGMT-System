<?php

	class Main extends CI_Controller {
		function index() {
			$session = $this->session->all_userdata();
			if (isset($session['logged_in']) && $session['logged_in']) {
				$data = array(
					'main_content' => 'user/index',
					'title' => 'User Page'
				);
				$this->load->view('includes/template', $data);
				switch ($session['role']) {
				case 'patron':
					redirect('user');
					break;
				case 'tech':
					redirect('tech');
					break;
				case 'admin':
					redirect('admin');
					break;
				}
			} else {
				$data = array('main_content' => 'main');
				$this->load->view('includes/template', $data);
			}

		}

	}
