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
			$this->load->helper('string');
			// set all the values from the form that was submitted.
			$first = $this->input->post('firstName');
			$last = $this->input->post('lastName');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$authKey = random_string('alnum', 15);

			if ($this->User_model->create_user($first, $last, $email, $password, $authKey)) {// if creating the new user work
				//  setup all the mail config stuff.
				$this->load->library('email');
				$config['smtp_host'] = 'mail.4850project.com';
				$config['protocol'] = 'smtp';
				$config['smtp_post'] = '2525';
				$config['smtp_user'] = 'servicecenter+4850project.com';
				$config['smtp_pass'] = 'asdfasdf';
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$this->email->from('ServiceCenter@4850Project.com', 'Service Center');
				$this->email->to($email);
				$this->email->subject('Service Center account activation');
				$this->email->message('Please click ' . anchor(site_url("login/activate/" . $authKey), 'this link') . ' to confirm your registration.');

				if ($this->email->send()) {// if it worked
					$data = array(
						'main_content' => 'login',
						'message' => 'Please check your email for your activation link.'
					);
					$this->load->view('includes/template', $data);
				}

			} else { // if the user creation fails...

			}
		}

	}

	function activate($authKey = null) {
		if (isset($authKey)) {// if the auth key is in the url
			$this->load->model('user_model');
			if ($this->user_model->activate_user($authKey)) {// if the table update was successful
				$data = array(
					'main_content' => 'login',
					'message' => 'Activation successful, you may login below.'
				);
				$this->load->view('includes/template', $data);
			}

		} else {// if the authentication is not in the url
			$data = array(
				'main_content' => 'login',
				'message' => 'Sorry, that activation code doesn\'t work.'
			);
			$this->load->view('includes/template', $data);
		}
	}

}
?>