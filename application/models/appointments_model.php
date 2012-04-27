<?php
class Appointments_Model extends CI_Model
{
	function get_availability($dayofweek)
	{
		// SQL query to get availability
		$result = $this->db->query("SELECT * FROM availability WHERE dayofweek = '$dayofweek'");
		
		if($result->num_rows() > 0)
		{
			$availability = array();
			$starttime = array(); 
			$endtime = array();
			$numrows = $result->num_rows();
			
			// Grab the start time and end time for every employee's schedule. 
			// Store the values in their respective arrays. Iterate through the two arrays and
			// divide up all the schedules into 1-hour segments.
			for($i = 0; $i < $numrows; $i++) 
			{
				$row = $result->row($i);
				$starttime[] = $row->starttime;
				$endtime[] = $row->endtime;

				$time = $starttime[$i];
				$j = 0;

				while($time < $endtime[$i])
				{
					$availability[] = $time;
					$time = $this->sum_the_time($time, '01:00:00'); 
					$j++;
				}
			}
			
			return $availability;	
		}
		
		else return NULL;		
	}
	
	function get_appointments($availability, $mydate)
	{
		//$result = $this->db->select('*')->from('appointments')->where('date', $mydate)->get()->result();
		$result = $this->db->query("SELECT * FROM appointments WHERE date = '$mydate'");
		
		if($result->num_rows() > 0)
		{
			$numrows = $result->num_rows();
			
			// Put all scheduled appointments into an array.	
			for($i = 0; $i < $numrows; $i++)
			{
				$row = $result->row($i);
				$appointments[] = $row->timeslot;
			}
			
			// For every scheduled appointment, loop through the list of available times.
			// When a sceduled appointment is matched with an available time, remove that
			// time from the list. The times that remain are the times that are available
			// to the customer to schedule an appointment.
			for($i = 0; $i < sizeof($appointments); $i++)
			{
				for($j = 0; $j < sizeof($availability); $j++)
				{
					if($appointments[$i] == $availability[$j])
					{
						unset($availability[$j]);
					}
				}
			}
		}
		
		// Duplicate available appointment times are removed and the list is re-indexed.
		$availability = array_unique($availability);
		$availability = array_values($availability);
		
		return $availability;
	}

	function insert_appointment($date, $SQLtime)
	{
		$this->load->database();
		$data = array(
				'description' => $this->input->post('description'),
				'date' => $date,
				'timeslot' => $SQLtime);
				
		$this->db->insert('appointments', $data); 
	}
	
	function generate_appointments($mydate, $dayofweek)
	{
		if(strtotime($mydate) < strtotime(date('Y-m-d')))
		{
			return "You cannot schedule an appointment for a past date.";
		}
		
		// Message displayed if there are no techs scheduled for that day.
		$availability = $this->get_availability($dayofweek);
		
		if($availability == NULL)
		{
			return "No available appointments on this date.";	
		}
		
		$appointments = $this->get_appointments($availability, $mydate);
		
		// Generate table with available appointments for user to view.
		$data = "<table cellpadding=10 border=1>";
		for($i = 0; $i < sizeof($appointments); $i++)
		{
			$apptime = date("g:i a", strtotime($appointments[$i]));
			$SQLtime = date("H:i:i", strtotime($apptime));
			$data .= "<tr>";
			$data .= '<td> <a href="'.base_url().'index.php/appointments/set_schedule/'.$mydate.'/'.$SQLtime.'/">'.$apptime.'</a></td>';
			$data .= "</tr>";
		}
		$data .= "</table>"; 
		return $data;
	}
	
	// Takes two time variables in the format of 00:00:00 and adds them together.
	function sum_the_time($time1, $time2) 
	{
	 	$times = array($time1, $time2);
	  	$seconds = 0;
	  	foreach ($times as $time)
	  	{
			list($hour,$minute,$second) = explode(':', $time);
		    $seconds += $hour * 3600;
	    	$seconds += $minute * 60;
	    	$seconds += $second;
	  	}
	  	$hours = floor($seconds / 3600);
	  	$seconds -= $hours * 3600;
	  	$minutes  = floor($seconds / 60);
	  	$seconds -= $minutes * 60;
	  	// return "{$hours}:{$minutes}:{$seconds}";
	  	return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); 
	}
}
?>