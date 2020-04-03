<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		//$this->load->view('users_list');
		if (!$this->session->userdata('type')){
			redirect(base_url());
		}
		$data['users'] = $this->user_model->get_all();

		$this->render_page('users_list', $data);
	}


	public function list_all()
	{
		$data['users'] = $this->user_model->get_all();

		return $this->load->view('users_table', $data);
	}

	public function add_user() {

		$names = $this->input->post('names');
		$last_name = $this->input->post('last_name');
		$mothers_last_name = $this->input->post('mothers_last_name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user_type = $this->input->post('user_type');

		$this->user_model->add($names, $last_name, $mothers_last_name, $email, $password, $user_type);

		$data['users'] = $this->user_model->get_all();
		return $this->render_page('users_list', $data);
	}

	public function	update_user() {
		$id = $this->input->post('id');
		$names = $this->input->post('names');
		$last_name = $this->input->post('last_name');
		$mothers_last_name = $this->input->post('mothers_last_name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user_type = $this->input->post('user_type');


		$this->user_model->update($id, $names, $last_name, $mothers_last_name, $email, $password, $user_type);

		$data['users'] = $this->user_model->get_all();
		return $this->render_page('users_list', $data);
	}

	public function delete_user() {
		$id = $this->input->post('id');

		$this->user_model->delete($id);

		$data['users'] = $this->user_model->get_all();
		return $this->render_page('users_list', $data);
	}

	
}
