<?php

class calendar extends CI_Controller {
	function index() {
		$prefs = array(
			'show_next_prev' => TRUE,
			'next_prev_url' => site_url('calendar/index')
		);	
		$this -> load -> library('calendar', $prefs);
		echo $this -> calendar -> generate($this -> uri -> segment(3), $this -> uri -> segment(4));
	}
	
	

}
