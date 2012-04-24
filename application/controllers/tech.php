<?php

class Tech extends Tech_Controller {

	function index() {
		$this->load->model('user_model');
		$data = array(
			'main_content' => 'tech/index',
			'title' => 'Tech Page',
			'user' => $this->user_model->get_info($this->session->userdata('email'))
		);
		$this->load->view('includes/template', $data);
	}

	function update() {
		$this->load->model('user_model');
		$data = array(
			'main_content' => 'tech/index',
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


	
	function requests_table($sort_by = 'report_id', $sort_order = 'asc', $offset = 0) {
		$this->load->library('tablebuilder');
		$this->tablebuilder->display($sort_by, $sort_order, $offset, 'tech', 'requests', $this->session->userdata('id'));
	}
	
}
