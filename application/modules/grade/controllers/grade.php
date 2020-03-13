<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grade extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("gradeModel");
	}

	public function index()
	{	
	}

	public function evaluation($id, $idSubject) {
		$data['id'] = $id;
		$data['idSubject'] = $idSubject;
		$this->render_page('grade', $data);
	}

	public function getGrades($id, $idSubject){
	 	$data['grades'] = $this->gradeModel->getGrades($id, $idSubject);
		return $this->load->view('gradeTable',$data);
	}

	public function evaluationInfo($id) {
		$data['ev'] = $this->gradeModel->getEvaluation($id);
		return $this->load->view('evaluationInfo',$data);
	}

	public function editGrade() {
		$grade = $this->input->post("grade");
		$obs = $this->input->post("obs");
		$matricula = $this->input->post("matricula");
		$evId = $this->input->post("idEvaluation"); 
		return $this->gradeModel->updateGrade($grade, $obs, $matricula, $evId);
	}

}
