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
		$this->load->model('schedule');

		foreach ($schedule as $s) {
			$day_of_week = $s['day_of_week'];
			$user_id = $s['user_id'];
			$time = date('H:i:s', strtotime($s['time']));
			$when = $s['when'];
			$this->schedule->update_schedule($user_id, $day_of_week, $when, $time);
		}

	}

	function faq() {
		$this->load->model('faq_model');

		$data = array(
			'main_content' => 'admin/index',
			'secondary_content' => 'admin/faq',
			'faqs' => $this->faq_model->get_faqs()
		);
		$this->load->view('includes/template', $data);
	}

	function faq_delete() {
		$data = $this->input->post('faqs');
		$this->load->model('faq_model');
		for ($i = 0; $i < sizeof($data); $i++) {
			$this->faq_model->delete_question($data[$i]);
		}
		redirect('admin/faq');

	}

	function faq_add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answer', 'Answer', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Validation failed');
			echo 'failure!';
		} else {
			$this->load->model('faq_model');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');
			$this->faq_model->insert_question($question, $answer);
			redirect('admin/faq');
		}
	}

}
