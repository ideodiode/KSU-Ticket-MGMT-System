<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tablebuilder {

    public function display($sort_by, $sort_order, $offset, $role, $table, $user_id) {
		
		$limit = 3; //Number of results displayed per page
		
		$CI =& get_instance(); //Required for library classes
		$model_name = $table . "_model";
		$CI->load->model($model_name);
		
		$select_user = $user_id;
		if ($role == 'admin')
			$select_user = NULL;
		
		$results = $CI->$model_name->search($limit, $offset, $sort_by, $sort_order, $select_user);
		$data['fields'] = $CI->$model_name->display_fields();
		
		
		//Retreive all results as well as the total number
		$data['results'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		
		
		// pagination
		$CI->load->library('pagination');
		$config = array();
		
		/*
		/
		/Needs to edited for AJAX
		/
		/*/
		
		$config['base_url'] = site_url($role . "/" . $table . "_table/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$CI->pagination->initialize($config);
		$data['pagination'] = $CI->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$data['role'] = $role;
		$data['table'] = $table;
		
		
		$data['main_content'] = $role . '/index';
		$data['title'] = $role . ' Page';
		$data['table_content'] = 1;

		$CI->load->view('includes/template', $data);
	}
}
