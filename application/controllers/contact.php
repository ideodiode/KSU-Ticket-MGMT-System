<?php

class Contact extends CI_Controller {
	function index() {
		$data['main_content'] = 'contact';
		if ($this -> session -> userdata('logged_in')) {
			$this -> load -> model('user_model');
			$user = $this -> user_model -> get_info($this -> session -> userdata('email'));
		}
		if (isset($user)) {
			$data['user'] = $user;
		}
		$this -> load -> view('includes/template', $data);
	}

	function send() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('name', 'Name', 'trim|required');
		$this -> form_validation -> set_rules('email', 'Email Address', 'trim|required|email');
		$this -> form_validation -> set_rules('subject', 'Subject', 'trim|required');
		$this -> form_validation -> set_rules('issue', 'Issue', 'trim|required');
		if ($this -> form_validation -> run() == FALSE) {// if information in invalid
			$this -> load -> view('includes/template', array('main_content' => 'contact'));
		} else {
			//  setup all the mail config stuff.
			$this -> load -> library('email');
			$config['smtp_host'] = 'mail.4850project.com';
			$config['protocol'] = 'smtp';
			$config['smtp_post'] = '2525';
			$config['smtp_user'] = 'servicecenter+4850project.com';
			$config['smtp_pass'] = 'asdfasdf';
			$config['mailtype'] = 'html';
			$this -> email -> initialize($config);

			$this -> email -> from($this -> input -> post('email'), $this -> input -> post('name'));
			$this -> email -> to('servicecenter@4850project.com');
			$this -> email -> subject($this -> input -> post('subject'));
			$this -> email -> message($this -> input -> post('issue'));

			if ($this -> email -> send()) {// if sending the email worked.
				$data = array(
					'main_content' => 'contact',
					'message' => 'Your message has been sent!'
				);
				$this -> load -> view('includes/template', $data);
			} else {// if sending the email failed.
				echo 'Error! Try again!';
				echo $this -> email -> print_debugger();

			}
		}

	}

}
