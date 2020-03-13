<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class evaluation extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model("evaluationModel");
	}

	public function index()
	{	
		$this->render_page('evaluation');
	}

	public function ev($id) {
		$data['id'] = $id;
		$this->render_page('evaluation', $data);
	}

	public function getEvaluations($id){
	
	 	$data['evaluations'] = $this->evaluationModel->getEvaluations($id);
		return $this->load->view('evaluationsTable',$data);
	}

	public function save(){
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$date = $this->input->post("date");
		$idSubject = $this->input->post("idSubject");
		return $this->evaluationModel->saveEvaluation($title, $description, $date,$idSubject);
	}

	public function update(){
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$date = $this->input->post("date");
		$id = $this->input->post("idEv");
		return $this->evaluationModel->updateEvaluation($title, $description, $date, $id);
	}
}
