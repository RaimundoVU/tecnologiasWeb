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
		$data['id_asig'] = 0;
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
		$matricula = $this->input->post('matricula');
		$subject_id = $this->input->post('subject_id');
		$data = array(
			'matricula' => $this->input->post('matricula'),
			'nombre' => $this->input->post('nombre'),
			'apellido_materno' => $this->input->post('apellido_m'),
			'apellido_paterno' => $this->input->post('apellido_p')
		);
		$data_subject = [
			'id_estudiante' => $matricula,
			'id_instancia_asignatura' => $subject_id
		];
		if(!$this->student_model->check($matricula)){
			if ($this->student_model->check_student_in_subject($data_subject)) {
				$this->student_model->add_student_in_subject($data_subject);
				$this->student_model->add_nota($subject_id, $matricula);
				echo json_encode( array('ok' => true) );
				return;
			}
		}
		else{
			$this->student_model->add_student($data);
			$this->student_model->add_student_in_subject($data_subject);
			$this->student_model->add_nota($subject_id, $matricula);
			echo json_encode( array('ok' => true) );
			return;
		}
		echo json_encode( array('ok' => false) );
		return;
	}

	public function excel_upload()
	{
		$subject_id = $_POST['subject_id'];
		if(!empty($_FILES['file']['name'])) { 
			// get file extension
			$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			if($extension == 'csv'){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		
			// array Count
			$arrayCount = count($allDataInSheet);
			$flag = 0;
			$createArray = array('matricula', 'nombre', 'apellido_paterno', 'apellido_materno');
			$makeArray = array('matricula' => 'matricula', 'nombre' => 'nombre', 'apellido_paterno' => 'apellido_paterno', 'apellido_materno' => 'apellido_materno');
			$SheetDataKey = array();
			foreach ($allDataInSheet as $dataInSheet) {
				foreach ($dataInSheet as $key => $value) {
					if (in_array(trim($value), $createArray)) {
						$value = preg_replace('/\s+/', '', $value);
						$SheetDataKey[trim($value)] = $key;
					} 
				}
			}
			$dataDiff = array_diff_key($makeArray, $SheetDataKey);
			if (empty($dataDiff)) {
				$flag = 1;
			}
			// match excel sheet column
			if ($flag == 1) {
				for ($i = 1; $i <= $arrayCount; $i++) {
					$matricula = $SheetDataKey['matricula'];
					$nombre = $SheetDataKey['nombre'];
					$apellido_paterno = $SheetDataKey['apellido_paterno'];
					$apellido_materno = $SheetDataKey['apellido_materno'];
					
					$matricula = filter_var(trim($allDataInSheet[$i][$matricula]), FILTER_SANITIZE_STRING);
					$nombre = filter_var(trim($allDataInSheet[$i][$nombre]), FILTER_SANITIZE_STRING);
					$apellido_paterno = filter_var(trim($allDataInSheet[$i][$apellido_paterno]), FILTER_SANITIZE_STRING);
					$apellido_materno = filter_var(trim($allDataInSheet[$i][$apellido_materno]), FILTER_SANITIZE_STRING);
					if (strlen($matricula)>0 && strcmp($matricula, "matricula")!=0) {
						$fetchData = array('matricula' => $matricula, 'nombre' => $nombre, 'apellido_paterno' => $apellido_paterno, 'apellido_materno' => $apellido_materno);
						$data = [
							'id_estudiante' => $matricula,
							'id_instancia_asignatura' => $subject_id
						];
						if(!$this->student_model->check($matricula)){
							if ($this->student_model->check_student_in_subject($data)) {
								$this->student_model->add_student_in_subject($data);
								$this->student_model->add_nota($subject_id, $matricula);
							}
						}
						else{
							$this->student_model->add_student($fetchData);
							$this->student_model->add_student_in_subject($data);
							$this->student_model->add_nota($subject_id, $matricula);
						}	
					}
				}
			} else {
				return "Please import correct file, did not match excel sheet column";
			}
		}
		return "Alumnos agregados correctamente";
	}


	public function fetch_matricula()
	{
		$returnData = array();
        
        // Get skills data
		$conditions['searchTerm'] = $this->input->get('term');
        //$conditions['conditions']['status'] = '1';
        $skillData = $this->student_model->getRows($conditions);
        
        // Generate array
        if(!empty($skillData)){
            foreach ($skillData as $row){
                $data['id'] = $row['matricula'];
				$data['value'] = $row['matricula'];
				$data['nombre'] = $row['nombre'];
				$data['apellido_paterno'] = $row['apellido_paterno'];
				$data['apellido_materno'] = $row['apellido_materno'];	
                array_push($returnData, $data);
            }
        }
        
        // Return results as json encoded array
        echo json_encode($returnData);
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

	public function getStudentSubjects()
	{
		try {
			$matricula = $this->input->post("matricula");
			$data['asignaturas'] = $this->student_model->getStudentSubjects($matricula);
			$data['matricula'] = $matricula;
			return $this->load->view('resumeTable',$data);
			//echo json_encode($data);
		} catch (\Exception $e) {
			echo json_encode(['ok'=>false, 'error'=>$e->getMessage()]);
			return;
		}
	}

	public function getStudentGrades()
	{
		try {
			$matricula = $this->input->post("matricula");
			$id_ins_asig = $this->input->post("id_ins_asig");
			$data['grades'] = $this->student_model->getStudentGrades($matricula, $id_ins_asig);
			return $this->load->view('resumeGrades', $data);
		} catch (\Exception $e) {
			echo json_encode(['ok'=>false, 'error'=>$e->getMessage()]);
			return;
		}
	}
}
