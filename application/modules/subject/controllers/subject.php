<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('subject_model');
		$this->load->model('subject_instance_model');
		$this->load->model('subject_user_model');
		
       
    }
    
    public function index($id = 0)
	{	
		//$this->load->view('subject_list');
		switch($this->session->userdata('type'))
		{
			case 1:
				$data['subjects'] = $this->subject_model->get_all();
				$this->render_page('subject_list_admin',$data);
				break;
			case 2:
				$data['subjects'] = $this->subject_model->get_all();
				$data['proffesors'] = $this->subject_user_model->get_all_proffesors();
				
				$this->render_page('subject_list_director',$data);

				break;

			case 3:

				$data['subjects'] = $this->subject_instance_model->get_all($this->session->userdata('email'));
				$this->render_page('subject_list',$data);
				break;
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

	public function fetch()
	{
		$returnData = array();
        
        // Get skills data
        $conditions['searchTerm'] = $this->input->get('term');
        //$conditions['conditions']['status'] = '1';
        $skillData = $this->subject_model->getRows($conditions);
        
        // Generate array
        if(!empty($skillData)){
            foreach ($skillData as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['nombre'];
                array_push($returnData, $data);
            }
        }
        
        // Return results as json encoded array
        echo json_encode($returnData);
	}

	public function edit_subject()
	{
		$id = $this->input->post('code');
		$name = $this->input->post('name');
		$this->subject_model->update($id,$name);
	}

	public function add_subject()
	{




		$code_subject = $this->input->post("code");
		$name_subject = $this->input->post("name");


		if ($this->subject_instance_model->check($code_subject, $name_subject))
		{
			$this->subject_model->add($code_subject,$name_subject);
			echo json_encode( array('ok' => true) );
			return;
		}else{
			echo json_encode( array('ok' => false) );
			return;
		}

		
	}


	public function add_subject_with_instance()
	{



		
		$code_subject = $this->input->post("code");
		$name_subject = $this->input->post("name");
		$id_proffesor = $this->input->post("proffesor");
		$semestre = $this->input->post("semester");
		
		

		if ($this->subject_instance_model->check($code_subject, $name_subject))
		{
			$this->subject_model->add($code_subject,$name_subject);
			$year = date('Y');
			$id_subject = $this->subject_instance_model->get_id_subject($code_subject, $name_subject);
			$this->subject_instance_model->add($id_subject,$semestre,$id_proffesor,$year);
			
			
			



			echo json_encode( array('ok' => true) );
			return;
		}else{
			echo json_encode( array('ok' => false) );
			return;
		}

		
	}



	public function edit_subject_with_instance()
	{
		$id = $this->input->post('code');
		$name = $this->input->post('name');
		$proffesor = $this->input->post('proffesor');
		$semestre = $this->input->post("semestre");
		$this->subject_model->update($id,$name);
		$id_subject = $this->subject_instance_model->get_id_subject($id, $name);
		$year = date('Y');
		$this->subject_instance_model->add($id_subject,$semestre,$proffesor,$year);
	}


	public function add_subject_instance()
	{
		$idSubject = $this->input->post("idSubject");
		$semester = $this->input->post("semester");
		$idUser = $this->subject_instance_model->get_teacher_id($this->session->userdata('email'));
		$year = date('Y');
		$this->subject_instance_model->add($idSubject,$semester,$idUser,$year);
	}

	public function instances($id)
	{
		$result = $this->subject_instance_model->get_subject_id($id);

		echo json_encode($result);
	}

	public function subjects($id)
	{
		$result = $this->subject_instance_model->get_subject_id($id);

		echo json_encode($result);
	}


	public function show_subjects($id)
	{


		$data['subjects'] = $this->subject_instance_model->get_subject_id($id);
		$this->render_page('subject_list',$data);
	}

	
	
	
}

?>
