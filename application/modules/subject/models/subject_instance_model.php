<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_instance_model extends CI_Model{
    public function __construct()
    {
      parent::__construct();
    }
  
    public function index()
    {
      // 
    }
    
    public function get_all()
    {
        $this->db->select('*');
        return $this->db->get('instancia_asignatura')->result();
    }

    public function add($code,$date,$professor_id)
    {
        $data['codigo_asignatura'] = $code;
        $data['fecha']= $date;
        $data['id_profesor']= $professor_id;
        $this->db->insert('instancia_asignatura',$data);
    }

}