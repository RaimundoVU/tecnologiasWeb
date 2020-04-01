<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('subject/subject_instance_model');
		$this->load->model('subject/subject_model');
		$this->load->model('evaluation/evaluationModel');
	}

	public function index()
	{
		//$this->load->view('users_list');
		$data['users'] = $this->user_model->get_all();
		$data['instances'] = $this->subject_instance_model->get_all_instances();
		$data['sections'] = ['Cálculo I', 'Introducción a la programación','Cómo acosar en ayudantias', 'Cómo ser infunable I', 'Cómo ser infunable II', 'Algoritmos y estructuras de datos', 'COA I' ];

		$this->render_page('dashboard', $data);
	}
	
}
