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
		switch($this->session->userdata('type'))
		{
			case 1:

				
				break;

			case 2:
				$data['subjects'] = $this->subject_model->get_all();
				$this->render_page('subject_list_admin',$data);
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
		$this->subject_model->add($code_subject,$name_subject);
	}

	public function add_subject_instance()
	{
		$idSubject = $this->input->post("idSubject");
		$semester = $this->input->post("semester");
		$idUser = $this->subject_instance_model->get_teacher_id($this->session->userdata('email'));
		$year = date('Y');
		$this->subject_instance_model->add($idSubject,$semester,$idUser,$year);
	}


	
	
	
}

?>
