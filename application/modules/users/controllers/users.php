<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		//$this->load->view('users_list');
		$this->render_page('users_list');
	}


	public function list_all()
	{
		
		return $this->user_model->get_all();
	}
	
}
