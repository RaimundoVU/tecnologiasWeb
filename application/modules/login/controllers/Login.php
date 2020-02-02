<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("loginModel");
		$this->load->library('session');
	}
	
	public function index()
	{
	}

	public function logeo(){
		
		$correo = $this->input->post("email");
		$clave = $this->input->post("password");
		$data['correo'] = $correo;
		$login= FALSE;
		$login = $this->loginModel->validarUsuario($correo,$clave);
		$data['login'] =$login;
		$this->session->set_userdata($data);
		header('Content-Type: application/json');
		$response = ['login'=>$login,'correo'=>$correo, 'expirate'=>$this->session];
		echo json_encode($response);
	}
}
