<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grade extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("gradeModel");
	}

	public function index()
	{	
		$this->render_page('grade');
	}

	public function evaluation($id) {
		$data['id'] = $id;
		$this->render_page('grade', $data);
	}

	public function getGrades($id){
	
	 	$data['grades'] = $this->gradeModel->getGrades($id);
		return $this->load->view('estudentsTable',$data);
	}

}
