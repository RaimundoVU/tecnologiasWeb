<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends MY_Controller {
	var $path;
	var $files;
	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('subject_model');
		$this->load->model('subject_instance_model');
		$this->load->helper('file');
		$this->load->helper('directory');
		$this->load->helper('download');
		$this->path = "./filesys";
		$this->load->library('zip');
       
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


	public function detail($id) {
		
		if (!is_dir($this->path.DIRECTORY_SEPARATOR.$id)) {
			mkdir($this->path.DIRECTORY_SEPARATOR.$id,0777,TRUE);
		}
		$this->path = $this->path."/".$id;

		$data['subject'] = $this->subject_instance_model->get_subject($id);
		$data['idSubject'] = $id;
		$data['directories'] = directory_map($this->path);
		$data['path'] = $this->path;
		$this->render_page('subject_view', $data);
	}

	public function getInfo() {
		$subPath = $this->input->post("subPath");
		$path = $this->input->post("path");
		echo json_encode(directory_map($path.DIRECTORY_SEPARATOR.$subPath.DIRECTORY_SEPARATOR));
	}
	
	public function createFolder() {
		$pathFolder = $this->input->post("pathFolder");
		$path = $this->input->post("path");
		$folderName = $this->input->post("name");
		if ($folderName != ""){
			mkdir($path."/".$pathFolder."/".$folderName,0777,TRUE);
		}
		
	}

	public function upload() {
		$pathInput = $this->input->post("pathInput");
		$path = $this->input->post("principalPath");

		$config['allowed_types'] = '*';
		$config['upload_path'] = $path.DIRECTORY_SEPARATOR.$pathInput;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('inputFile')) {
			$imagen = $this->upload->data('file_name');
			$id = $this->input->post("idSubject");
			redirect(base_url()."/subject/detail/".$id);
		} else {
			print_r($this->upload->display_errors());
		}
	}

	public function downloadFile($nro) {
		$this->load->helper('download');
		$name ="pathFile".$nro;
		$currentPath = $this->input->post($name);
		$currentPath= realpath($currentPath);
		$content= file_get_contents($currentPath);
		force_download($currentPath, null);
	}

	public function createZip(){
		$pathToZip = $this->input->post("pathFolderZip");
		$name = $this->input->post("nameFolderZip");
		$pathToZip = realpath($pathToZip);
		$filename = $name.".zip";

        // Add directory to zip
		$this->zip->read_dir($pathToZip, false);
		
        // Download
        $this->zip->download($filename);
	}
}

?>
