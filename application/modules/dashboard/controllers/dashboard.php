<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		//$this->load->view('users_list');
		$data['users'] = $this->user_model->get_all();

		$this->render_page('dashboard', $data);
	}
	
}
