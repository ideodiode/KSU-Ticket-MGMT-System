<?php
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
	class Login extends CI_Controller {

		function index() {
			$data = array(
				'main_content' => 'login',
				'title' => 'Login to the system'
			);
			$this->load->view('includes/template', $data);
		}

		function validate() {
			$this->load->model('user_model');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($this->user_model->validate($email, $password)) {// If the user enters valid information to login
				$role = $this->user_model->get_role($email);
				$id = $this->user_model->get_id($email);
				$data = array(
					'email' => $email,
					'logged_in' => true,
					'role' => $role,
					'id' => $id
				);
				$this->session->set_userdata($data);
				//Get role and redirect to correct controller
				switch ($data['role']) {
					case 'patron' :
						redirect('user');
						break;
					case 'tech' :
						redirect('tech');
						break;
					case 'admin' :
						redirect('admin');
						break;
				}

			} else {// if the information entered is invalid
				$data = array(
					'main_content' => 'login',
					'title' => 'Login to the system',
					'error' => 'Please try again'
				);
				$this->load->view('includes/template', $data);
			}
		}

		function signup() {

			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('phoneNumber', 'Phone number', 'numeric');

			// set a custom error for when the email is already in the db.
			$this->form_validation->set_message('is_unique', "That email address already has an account.");
			$this->form_validation->set_message('min_length', 'Your password must be at least 4 characters.');
			$this->form_validation->set_message('valid_email', 'Your email address is invalid.');
			$this->form_validation->set_message('numeric', 'Invalid phone number. Must only contain numbers.');

			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Passowrd', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('password1', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {// if information in invalid
				$data = array(
					'main_content' => 'login',
					'errors' => validation_errors()
				);
				$this->load->view('includes/template', $data);

			} else {// if the information submitted is valid

				$this->load->model('User_model');
				$this->load->helper('string');

				// set all the values from the form that was submitted.
				$first = $this->input->post('firstName');
				$last = $this->input->post('lastName');
				$email = $this->input->post('email');
				$phone = $this->input->post('phoneNumber');

				$password = $this->input->post('password');
				$authKey = random_string('alnum', 15);

				if ($this->User_model->create_user($first, $last, $email, $phone, $password, $authKey)) {// if inserting user data worked
					//  setup all the mail config stuff.
					$this->load->library('email');
					$config['smtp_host'] = 'mail.4850project.com';
					$config['protocol'] = 'smtp';
					$config['smtp_port'] = '2525';
					$config['smtp_user'] = 'servicecenter+4850project.com';
					$config['smtp_pass'] = 'asdfasdf';
					$config['mailtype'] = 'html';
					$this->email->initialize($config);

					$this->email->from('ServiceCenter@4850Project.com', 'Service Center');
					$this->email->to($email);
					$this->email->subject('Service Center account activation');
					$this->email->message('Please click ' . anchor(site_url("login/activate/" . $authKey), 'this link') . ' to confirm your registration.');

					if ($this->email->send()) {// if sending the email worked.
						$this->session->set_flashdata('email', 'Please check your email for the activation link.');
						redirect('login');
					} else {// if sending the email failed.
						echo 'Something went wrong when we tried to send the email. Please try again.';
					}

				} else { // if the user creation fails...

				}
			}

		}

		function activate($authKey = null) {
			if (isset($authKey)) {// if the auth key is in the url
				$this->load->model('user_model');
				if ($this->user_model->activate_user($authKey)) {// if the table update was successful
					$this->session->set_flashdata('email', 'Activation successful. You may now login.');
					redirect('login');
					
				} else {
					$this->session->set_flashdata('error','That is an invalid activation code.');
					redirect('login');
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