<?php

	$this->load->view('includes/header');

	if (isset($main_content)) {
		$this->load->view($main_content);
	} else {
		echo 'You did not set a main_content and pass it to the view';
	}

	$this->load->view('includes/footer');
?>