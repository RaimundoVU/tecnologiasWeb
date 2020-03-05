<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_model extends CI_Model{
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
        return $this->db->get('asignatura')->result();
    }

    public function add($name )
    {
        $data['nombre'] = $name;
        $this->db->insert('asignatura',$data);
    }

    public function delete($id)
    {
        $this->db->where('codigo', $id);
  	    $this->db->delete('asignatura');
    }

    public function update($id,$name)
    {
        $data['nombre'] = $name;
        $this->db->where('codigo',$id);
        $this->db->update('asignatura',$data);
    }

}