<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class evaluation extends MY_Controller {

	var $idSubject;

	public function __construct(){
		parent::__construct();
		$this->idSubject = $this->input->get('idSubject');
		$this->load->model("evaluationModel");
	}

	public function index()
	{
		$this->render_page('evaluation');
	}

	public function getEvaluations(){
	 	$data['evaluations'] = $this->evaluationModel->getEvaluations(1);
		return $this->load->view('evaluationsTable',$data);
	}

	public function save(){
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$date = $this->input->post("date");
		$this->evaluationModel->saveEvaluation($title, $description, $date, $this->idSubject);
	}
}
