<?php
date_default_timezone_set('America/New_York');

class Appointments extends CI_Controller 
{
	
	function user_scheduler($year = null, $month = null, $day = null) 
	{
		if(strlen($day < 2))
		{
			$day = "0".$day;
		}
		$mydate = $year."-".$month."-".$day;
		echo $mydate;
		
		// The day of the week is represented by a number from 0 - 6 (Sunday - Saturday)
		$dayofweek = date('w', strtotime($mydate));

		$this->load->model('appointments_model');
		
		$data['appointment'] = $this->appointments_model->generate_appointments($mydate, $dayofweek);
		
		$this->load->view('appointments', $data);
	}
	
	function set_schedule($date, $time)
	{	
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('appointment_form');
		}
		else
		{
			$this->load->model('appointments_model');
			$this->appointments_model->insert_appointment($date, $time);
			$this->load->view('form_success');
		}
	}
	
}