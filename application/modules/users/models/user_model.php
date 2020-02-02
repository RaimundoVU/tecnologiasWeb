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
    return $this->db->get('usuario');
  }



}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */