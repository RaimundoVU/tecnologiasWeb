<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model User_model
 *
 * This Model for Users of the application
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class User_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    // 
  }

  public function get_all() {
    $this->db->select('*');
    return $this->db->get('usuario')->result();
  }

  public function add($names, $last_name, $mothers_last_name, $email, $password, $user_type) {
  	$data['nombres'] = $names;
  	$data['email'] = $email;
  	$data['apellido_materno'] = $mothers_last_name;
  	$data['apellido_paterno'] = $last_name;
  	$data['clave'] = $password;
	$data['tipo'] = $user_type;
	$data['fechaIngreso'] = date('Y-m-d',time());

  	$this->db->insert('usuario', $data);
  }

	public function update($id, $names, $last_name, $mothers_last_name, $email, $password, $user_type) {
  		$data['nombres'] = $names;
		$data['email'] = $email;
		$data['apellido_materno'] = $mothers_last_name;
		$data['apellido_paterno'] = $last_name;
		$data['clave'] = $password;
		$data['tipo'] = $user_type;

		$this->db->where('id_usuario', $id);
		$this->db->update('usuario', $data);
	}

  public function delete($id) {
  	$this->db->where('id_usuario', $id);
  	$this->db->delete('usuario');
  }



}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
