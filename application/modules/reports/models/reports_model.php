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

class Reports_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    //  
  }

  function getTeachersByDate($date)
  {
      $query = "select * from usuario where fechaIngreso <= '".$date."' AND usuario.tipo = 3";
      
      return $this->db->query($query)->result();
  }
  
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */