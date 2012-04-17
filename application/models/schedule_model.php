<?php
	class Schedule_model extends CI_Model {

		function search($limit, $offset, $sort_by, $sort_order, $select_user) {
			$days_of_week = array(// get all the days of the week so that we can go through them. If you want them in a different order, rearrange them here.
				'Monday',
				'Tuesday',
				'Wednesday',
				'Thursday',
				'Friday',
				'Saturday',
				'Sunday'
			);
			$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
			$sort_columns = $days_of_week;
			$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : "user_id";

			$techs = $this->db->select('user_id')->from('Users')->where('role', 'tech')->get()->result();
			// get list of techs so we can get days in order.

			// number of rows we're going to have, aka the number of techs

			$tech_schedule = array();
			// make an overall schedule of all the techs. Should contain one object per tech.
			foreach ($techs as $tech) {// go through the list of techs and get their schedule.
				$schedule = array();
				// make an object to be stored in the tech_schedule.
				foreach ($days_of_week as $day) {// get all the days of their schedule
					$schedule_obj = $this->db->select('day_of_week, start_time, end_time')->from('schedule')->where('user_id', $tech->user_id)->where('day_of_week', $day)->get()->result();
					// get the start, end, and day of their schedule
					$schedule[] = $schedule_obj[0];
					// add it to the individual schedule object
				}
				$tech_schedule[$tech->user_id] = $schedule;
				// add the individual schedule object to the oberall tech schedule at key user_id.

			}
			$ret['rows'] = $tech_schedule;
			// an array of schedules. Each array is a set of objects for each day.
			$ret['num_rows'] = sizeof($techs);
			$eachrow = array();

			foreach ($ret['rows'] as $id => $rows) {// every time there is a different user...
				$schedule = new stdClass;
				$schedule->user = $id;
				foreach ($rows as $row) {// go through their array and make a new, simpler, object.
					//print_r($row);
					//echo '<br>';
					$day = $row->day_of_week;
					$schedule->$day = $row->start_time . ' - ' . $row->end_time;
				}
				$eachrow[] = $schedule;
			}
			$ret['rows'] = $eachrow;
			return $ret;
		}

		function display_fields() {

			return array(
				'user' => 'User',
				'Monday' => 'Monday',
				'Tuesday' => 'Tuesday',
				'Wednesday' => 'Wednesday',
				'Thursday' => 'Thursday',
				'Friday' => 'Friday',
				'Saturday' => 'Saturday',
				'Sunday' => 'Sunday'
			);

		}

	}
?>