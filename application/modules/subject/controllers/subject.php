<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('subject_model');
		$this->load->model('subject_instance_model');

       
    }
    
    public function index()
	{	
		//$this->load->view('subject_list');
		if($this->session->userdata('type')==3)
		{
			$data['subjects'] = $this->subject_model->get_all($this->session->userdata('email'));
			$this->render_page('subject_list',$data);
		}
		/*$data['subjects'] = $this->subject_model->get_all();
		$this->render_page('subject_list',$data);*/
	}

	public function list_all()
	{

		if($this->session->userdata('type')==3)
		{
			$data['subjects'] = $this->subject_model->get_all($this->session->userdata('email'));
			$this->render_page('subject_list',$data);
		}
		/*$data['subjects'] = $this->subject_model->get_all();

		$this->render_page('subject_list',$data); */
	}
	
	
}

?>
