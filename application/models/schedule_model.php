<?php
class Schedule_model extends CI_Model {

	function search($limit, $offset, $sort_by, $sort_order, $select_user) {

		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';

		$sort_columns = array(
			'user_id',
			'day_of_week',
			'start_time',
			'end_time'
		);
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : "user_id";

		// results query
		if ($select_user == NULL) {
			$q = $this->db->select('user_id, day_of_week, start_time, end_time')->from('Schedule')->limit($limit, $offset)->order_by($sort_by, $sort_order);
		} else {
			$q = $this->db->select('user_id, day_of_week, start_time, end_time')->from('Schedule')->where('user_id', $select_user)->limit($limit, $offset)->order_by($sort_by, $sort_order);
		}

		$ret['rows'] = $q->get()->result();
		// each row from the result. At the moment, this is one row per day the tech works. Maximum of 7 days per tech.

		//print_r($ret['rows']);
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)->from('Schedule');

		$tmp = $q->get()->result();

		$ret['num_rows'] = $tmp[0]->count;

		return $ret;
	}

	function display_fields() {
		$this->load->model('user_model');
		$user = $this->user_model->get_info_from_id('12');
		print_r($user);
		$days = array(
			$user => 'User',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
			'Sunday'
		);
		return $days;
	}

}
