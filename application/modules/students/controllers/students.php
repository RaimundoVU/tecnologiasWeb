<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class students extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('student_model');
	}

	public function index()
	{
		//$this->load->view('users_list');
		$data['resultado'] = $this->list_all();
		$this->render_page('students_list', $data);
	}

	public function subject($id_asig){
		$data['id_asig'] = $id_asig;
		$data['resultado'] = $this->get_students_in_subject($id_asig);
		$this->render_page('students_list', $data);
	}

	public function list_all()
	{
		return $this->student_model->get_all();
	}
	
	public function reload_view()
	{
		$data['resultado'] = $this->list_all();
		$this->load->view('students_list', $data);
	}

	public function add_student()
	{
		header('Content-Type: application/json');
		$data = array(
			'matricula' => $this->input->post('matricula'),
			'nombre' => $this->input->post('nombre'),
			'apellido_materno' => $this->input->post('apellido_m'),
			'apellido_paterno' => $this->input->post('apellido_p')
		);
		if ($this->student_model->check($this->input->post('matricula'))) 
		{
			$this->student_model->add_student($data);
			$this->add_student_in_subject($this->input->post('subject_id'), $data['matricula']);
			echo json_encode( array('ok' => true) );
			return;
		}
		echo json_encode( array('ok' => false) );
		return;
	}

	public function add_student_in_subject($id_asig, $matricula)
	{
		$data = [
			'id_estudiante' => $matricula,
			'id_instancia_asignatura' => $id_asig
		];

		if ($this->student_model->check_student_in_subject($data)) {
			$this->student_model->add_student_in_subject($data);
			echo json_encode(['ok'=>true]);
			return;
		}
		echo json_encode(['ok'=>false]);
		return;
	}

	public function update_student()
	{
		header('Content-type: application/json');
		$matricula = $this->input->post('matricula');
		$data = [
			'nombre' => $this->input->post('nombre'),
			'apellido_paterno' => $this->input->post('apellido_paterno'),
			'apellido_materno' => $this->input->post('apellido_materno')
		];
		try {
			$this->student_model->update_student($matricula, $data);
			echo json_encode(['ok'=>true]);
			return;
		} catch (\Exception $e) {
			echo json_encode(['ok'=>false, 'error'=>$e->getMessage()]);
			return;
		}
	}

	public function get_students_in_subject($subject_id)
	{
		try {
			return $this->student_model->get_students_in_subject($subject_id);	
		} catch (\Exception $e) {
			echo json_encode(['ok'=>false, 'error'=>$e->getMessage()]);
			return;
		}		
	}
}
