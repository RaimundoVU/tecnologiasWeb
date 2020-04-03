<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reports extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reports_model');
	}

	public function index()
	{
		if (!$this->session->userdata('type')){
			redirect(base_url());
		}
		$this->render_page('reports_view');
	}

	public function getTableReport1() {

		$subjectData = $this->reports_model->getSubjectAverage();
		$data['subjectData'] = $subjectData; 
		return $this->load->view('report1',$data);
	}

	public function getTableReport2() {
		//$data['data'] = $this->reports_model->getReport2();
		return $this->load->view('report2');
	}

	public function getTableReport3() {
		$data['data'] = $this->reports_model->getReport3();
		return $this->load->view('report3',$data);
	}

	public function getTableReport4() {
		return $this->load->view('report4');
	}

	public function getTableReport5() {
		return $this->load->view('report5');
	}

	public function getSubjectsByCant() {
		$cant = $this->input->post("cant");
		echo json_encode($this->reports_model->getSubjectsByCant($cant));
	}

	public function getTeachersByDate() {
		$date = $this->input->post("date");

		echo json_encode($this->reports_model->getTeachersByDate($date));
	}
	public function getTeachersDate() {
		$date = $this->input->post("date");

		echo json_encode($this->reports_model->getTeachersDate($date));
	}

	public function getSubjectsByNumber()
	{
		$number = $this->input->post('number');
		echo json_encode($this->reports_model->report4($number));
	}

}
