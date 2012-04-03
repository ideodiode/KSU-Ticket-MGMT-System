<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tablebuilder {

    public function display($sort_by, $sort_order, $offset, $model_name) {
		
		$limit = 3;
		
		
		
		$CI =& get_instance();
		$CI->load->model($model_name);
		
		$results = $CI->$model_name->search($limit, $offset, $sort_by, $sort_order);
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
		$config['base_url'] = site_url("user/tableTest/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$CI->pagination->initialize($config);
		$data['pagination'] = $CI->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
		$data['main_content'] = 'user/index';
		$data['title'] = 'Table Page';
		$data['table_content'] = 1;

		$CI->load->view('includes/template', $data);
	}
}
