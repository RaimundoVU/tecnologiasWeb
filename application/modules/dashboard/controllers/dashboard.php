<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('subject/subject_instance_model');
		$this->load->model('subject/subject_model');
		$this->load->helper('directory');
	}

	public function index()
	{
		//$this->load->view('users_list');
		$data['users'] = $this->user_model->get_all();
		$data['instances'] = $this->subject_instance_model->get_all_instances();

		$data['sections'] = ['Cálculo I', 'Introducción a la programación','Cómo acosar en ayudantias', 'Cómo ser infunable I', 'Cómo ser infunable II', 'Algoritmos y estructuras de datos', 'COA I' ];

		$this->render_page('dashboard', $data);
	}

	public function fetch()
	{
		$returnData = array();
        
        // Get skills data
        $search = $this->input->get('term');
        //$conditions['conditions']['status'] = '1';
        $skillData = $this->subject_instance_model->getRows($search);
        
        // Generate array
        if(!empty($skillData)){
            foreach ($skillData as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['nombre']." (".$row['anio']."-".$row['semestre'].")";
                array_push($returnData, $data);
            }
        }
        
        // Return results as json encoded array
        echo json_encode($returnData);
	}

	public function transferFiles() {
		$idFolder = $this->input->post("subject_code");
		$idSource = $this->input->post("sourceId");
		//transfer
		$pathSource = './filesys/'.$idSource;
		$pathDestination =  './filesys/'.$idFolder;

		$this->directory_copy($pathSource,$pathDestination);
		return true;
	}

	function directory_copy($srcdir, $dstdir)
    {
        //preparing the paths
        $srcdir=rtrim($srcdir,'/');
        $dstdir=rtrim($dstdir,'/');
		if (!is_dir($srcdir)) return;
        //creating the destination directory
        if(!is_dir($dstdir))mkdir($dstdir, 0777, true);
        
        //Mapping the directory
        $dir_map=directory_map($srcdir);

        foreach($dir_map as $object_key=>$object_value)
        {
            if(is_numeric($object_key))
                copy($srcdir.'/'.$object_value,$dstdir.'/'.$object_value);//This is a File not a directory
            else
                $this->directory_copy($srcdir.'/'.$object_key,$dstdir.'/'.$object_key);//this is a directory
        }
    }
	
}
