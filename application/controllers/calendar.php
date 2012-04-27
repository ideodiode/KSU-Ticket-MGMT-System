<?php
date_default_timezone_set('America/New_York');

class Calendar extends CI_Controller 
{
	
	function display($year = null, $month = null) 
	{
		if ($year == null or $month == null)
		{
			$year = date('Y');
			$month = date('m');
		}
		
		$this->load->model('calendar_model');
		$this->calendar_model->calendar_model($year, $month);
		
		if ($day = $this->input->post('day')) 
		{
			$this->calendar_model->add_calendar_data("$year-$month-$day", $this->input->post('data'));
		}
		
		$data['calendar'] = $this->calendar_model->generate($year, $month);
		
		$this->load->view('calendar', $data);
	}
}
