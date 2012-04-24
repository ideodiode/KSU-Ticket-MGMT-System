<?php

	class User extends User_Controller {

		function index() {
			$this->load->model('user_model');
			$data = array(
				'main_content' => 'user/index',
				'title' => 'User Page',
				'user' => $this->user_model->get_info($this->session->userdata('email'))
			);
			$this->load->view('includes/template', $data);
		}

		function update() {
			$this->load->model('user_model');

			$data = array(
				'main_content' => 'user/index',
				'secondary_content' => 'update',
				'user' => $this->user_model->get_info($this->session->userdata('email'))
			);
			$this->load->view('includes/template', $data);

		}

		function update_info() {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstName', 'First Name', 'trim|required|alpha');
			$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|alpha');
			$this->form_validation->set_rules('phone', 'Phone number', 'numeric');

			if (!$this->form_validation->run()) {// if the validation fails
				$role = $this->user_model->get_info($this->session->userdata('email'))->role;
				if ($role == 'patron') {
					$role = 'user';
				}
				$this->session->set_flashdata('msg', validation_errors());
				redirect($role . '/update');
			} else {
				$this->load->model('user_model');
				if ($this->user_model->update_user($this->session->userdata('email'), $this->input->post('firstName'), $this->input->post('lastName'), $this->input->post('phone'))) {// if we successfully update the user information
					$role = $this->user_model->get_info($this->session->userdata('email'))->role;
					if ($role == 'patron') {
						$role = 'user';
					}
					$this->session->set_flashdata('msg', '<p>Profile updated</p>');
					redirect($role . '/update');

				} else {

				}
			}

		}

		//Validation and submission of requests to database
		//	Scheduling/requestedTime not yet implemented
		function submit_request() {
			$this->load->library('form_validation');
			$this->load->model('User_model');
			$this->load->model('speciality_model');
			$this->form_validation->set_rules('description', 'Description of issue', 'required');
			$this->form_validation->set_rules('location', 'Location of issue', 'required');
		//	$this->form_validation->set_rules('requestedTime', 'Requested appointment time', 'required');

			if ($this->form_validation->run() == FALSE) {// if information in invalid
				$data = array(
					'main_content' => 'user/index',
					'secondary_content' => 'user/submitRequest',
					'user' => $this->user_model->get_info($this->session->userdata('email')),
					'specs' => $this->speciality_model->get_specialities()
				);
				$this->load->view('includes/template', $data);

			} else {// if the information submitted is valid

				$this->load->model('Requests_model');

				// set all the values from the form that was submitted.
				$description = $this->input->post('description');
				$location = $this->input->post('location');
				$requestedTime = $this->input->post('requestedTime');
				$speciality = $this->input->post('speciality');
				$userID = $this->session->userdata('id');
				if ($this->Requests_model->create_request($userID, $description, $location, $speciality)) {
					$this->session->set_flashdata('msg', 'Request submitted');
					redirect('user/submit_request');
				}
			}
		}

	

		function requests_table($sort_by = 'user_id', $sort_order = 'asc', $offset = 0) {
			$this->load->library('tablebuilder');
			$this->tablebuilder->display($sort_by, $sort_order, $offset, 'user', 'requests', $this->session->userdata('id'));
		}

	}
