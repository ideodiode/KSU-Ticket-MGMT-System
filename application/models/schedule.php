<div class="schedule">

<?php
class Schedule extends CI_Model {

	function get_schedule() {
		$days_of_week = array(
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
			'Sunday'
		);
		$possible_times = array(
			'12 AM',
			'1 AM',
			'2 AM',
			'3 AM',
			'4 AM',
			'5 AM',
			'6 AM',
			'7 AM',
			'8 AM',
			'9 AM',
			'10 AM',
			'11 AM',
			'12 AM',
			'1 PM',
			'2 PM',
			'3 PM',
			'4 PM',
			'5 PM',
			'6 PM',
			'7 PM',
			'8 PM',
			'9 PM',
			'10 PM',
			'11 PM',
			'12 PM'
		);
		$data = array();
		$headings = array('User');
		foreach ($days_of_week as $day) {// Add all the days of the week to the headings array.
			$headings[] = $day;
		}
		$data['headings'] = $headings;
		// Data = User | Monday | Tuesday | Wednesday | Thursday | Friday | Saturday | Sunday
			
		$techs = $this->db->select('user_id')->from('users')->where('role', 'tech')->get()->result();
		$temp = array();
		foreach ($techs as $tech) {
			$row = array();
			$tech_list[] = $tech->user_id;
			$row['user'] = $tech->user_id;

			foreach ($days_of_week as $day) {
				$sch = $this->db->select('start_time, end_time')->from('schedule')->where('user_id', $tech->user_id)->where('day_of_week', $day)->get()->row_array();
				$current = array();
				$current['start'] = $sch['start_time'];
				$current['end'] = $sch['end_time'];
				$current['type'] = 'dropdown';
				$row[$day] = $current;
			}
			$temp[] = $row;
		}
		$data['times'] = $possible_times;
		$data['data'] = $temp;
		$data['techs'] = $tech_list;
		return $data;
	}

	function update_schedule($user_id, $day_of_week, $when, $time) {

		$data = array('day_of_week' => $day_of_week);
		if ($when == "start") {
			$data['start_time'] = $time;
		} elseif ($when == "end") {
			$data['end_time'] = $time;
		}
		//$this->db->where('user_id', $user_id)->where('day_of_week', $day_of_week));
		$this->db->where('user_id', $user_id)->where('day_of_week', $day_of_week);
		return $this->db->update('schedule', $data);
	}
}
?>	

</div>
