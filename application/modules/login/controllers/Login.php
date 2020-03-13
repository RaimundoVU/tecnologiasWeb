<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("loginModel");
	}
	
	public function index()
	{
		if($this->session->userdata('login')){
			switch ($this->session->userdata('type')) {
				case 1:
					//usuario 1
					redirect(base_url()."users");
					break;
				case 2:
					//usuario 2
					redirect(base_url()."cambio2");
					break;
				case 3:
					//usuario 3
					redirect(base_url()."subject");
					break;
			}			
		}
		else{
			$this->load->view('login');
		}
	}

	public function in(){
		
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$data['email'] = $email;
		$login= FALSE;
		$login = $this->loginModel->validateUser($email,$password);
		$type = $this->loginModel->getUserType($email,$password);
		$data['type'] = $type;
		$data['login'] =$login;
		$this->session->set_userdata($data);
		$this->index();
	}
}
