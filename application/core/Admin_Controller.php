<?php
	class Admin_Controller extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model('user_model');
			$user = $this->user_model->get_info($this->session->userdata('email'));

			if (!$this->session->userdata('logged_in') || $user->role != 'admin') {// if not logged in or not an admin
				redirect('');
			}
		}

	}
