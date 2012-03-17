<?php
class Login extends CI_Controller {

	function index() {
		$data['main_content'] = 'login';
		$data['title'] = 'Login!';
		$this->load->view('includes/template', $data);
	}

	function validate() {
		$this->load->model('user');
		$query = $this->user->validate();

		if ($query) {// If the user enters valid information
			$data = array('email' => $this->input->post('email'), 'logged_in' => true);
			$this->session->set_userdata($data);
			redirect('members');

		} else {// if the information entered is invalid
			redirect('login');
		}
	}

}
?>