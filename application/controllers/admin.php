<?php

	class Admin extends Admin_Controller {

		function index() {
			$this->load->model('user_model');
			$data = array(
				'main_content' => 'admin/index',
				'title' => 'Admin Page',
				'user' => $this->user_model->get_info($this->session->userdata('email'))
			);
			$this->load->view('includes/template', $data);
		}

		function update() {
			$this->load->model('user_model');

			$data = array(
				'main_content' => 'admin/index',
				'secondary_content' => 'update',
				'user' => $this->user_model->get_info($this->session->userdata('email'))
			);
			$this->load->view('includes/template', $data);

		}

		function update_info() {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone number', 'numeric');

			if (!$this->form_validation->run()) {// if the validation fails
			} else {
				$this->load->model('user_model');
				if ($this->user_model->update_user($this->session->userdata('email'), $this->input->post('firstName'), $this->input->post('lastName'), $this->input->post('phone'))) {// if we successfully update the user information
					$data = array(
						'main_content' => 'tech/update',
						'user' => $this->user_model->get_info($this->session->userdata('email')),
						'message' => 'Successfully updated your info'
					);
					$this->load->view('includes/template', $data);
				} else {

				}
			}

		}

		function user_table($sort_by = 'user_id', $sort_order = 'asc', $offset = 0) {
			$this->load->library('tablebuilder');
			$this->tablebuilder->display($sort_by, $sort_order, $offset, 'admin', 'user', $this->session->userdata('id'));
		}

		function requests_table($sort_by = 'request_id', $sort_order = 'asc', $offset = 0) {
			$this->load->library('tablebuilder');
			$this->tablebuilder->display($sort_by, $sort_order, $offset, 'admin', 'requests', $this->session->userdata('id'));
		}

		function schedule_table($sort_by = 'user_id', $sort_order = 'asc', $offset = 0) {
			$this->load->model('schedule');
			$table_data = $this->schedule->get_schedule();

			$content['main_content'] = 'admin/index';
			$content['secondary_content'] = 'admin/schedule_table';
			$content['table'] = $table_data;
			$this->load->view('includes/template', $content);
		}

		function update_schedule() {
			$schedule = $this->input->post('schedule');
			foreach($schedule as $s ) {
				echo $s['user_id'];
			}

			// time comes in as 5 AM, for example.
			// $this->load->model('schedule');
			// $user_id = $this->input->post('user_id');

			// $day_of_week = $this->input->post('day_of_week');
			// $when = $this->input->post('when');
			// $time = $this->input->post('time');
			// $time = date('H:i:s', strtotime($time));
			// $done = $this->schedule->update_schedule($user_id, $day_of_week, $when, $time);
		}

	}
