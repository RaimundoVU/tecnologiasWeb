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

class Student_model extends CI_Model {

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
    $query = $this->db->get('estudiante');
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return ;
  }

  public function add_student($data)
  {
    $this->db->insert('estudiante',$data);
  }

  public function check($matricula)
  {
    $query = $this->db->get_where('estudiante', array(
      'matricula' => $matricula
    ));
    $count = $query->num_rows();
    return $count === 0;
  }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */