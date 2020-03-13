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
		echo $id;
	 	$data['grades'] = $this->gradeModel->getGrades($id);
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
		$evId = $this->data->id; 
		return $this->gradeModel->updateGrade($grade, $obs, $matricula, $evId);
	}

}
