<?php
class Login extends CI_Controller {

	function index() {
		$data = array(
			'main_content' => 'login',
			'title' => 'Login to the system'
		);
		$this->load->view('includes/template', $data);
	}

	function validate() {
		$this->load->model('User_model');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if ($this->User_model->validate($email, $password)) {// If the user enters valid information
			$data = array(
				'email' => $email,
				'logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('members');

		} else {// if the information entered is invalid
			$data = array(
				'main_content' => 'login',
				'title' => 'Login to the system',
				'error' => 'Those credentials do not work!'
			);
			$this->load->view('includes/template', $data);
		}
	}

	function signup() {
		$data = array('main_content' => 'register');
		//$this->load->view('includes/template', $data);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
		$this->form_validation->set_message('is_unique', "That email address already has an account");
		// set a custom error for when the email is already in the db.
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[Users.email]');
		$this->form_validation->set_rules('password', 'Passowrd', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password1', 'Password Confirmation', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE) {// if information in invalid

			$this->load->view('includes/template', array('main_content' => 'register'));

		} else {// if the information submitted is valid

			$this->load->model('User_model');

			// set all the values from the form that was submitted.
			$first = $this->input->post('firstName');
			$last = $this->input->post('lastName');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($this->User_model->create_user($first, $last, $email, $password)) {// if creating the new user work
				$data = array(
					'message' => 'Thanks for registering! Can login below.',
					'main_content' => 'login'
				);
				$this->load->view('includes/template', $data);
			} else {

			}
		}

	}

}
?>