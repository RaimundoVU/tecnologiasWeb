<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_model extends CI_Model{
    public function __construct()
    {
      parent::__construct();
      $this->dbTbl = 'asignatura';
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

    public function add($code,$name)
    {
        $data['nombre'] = $name;
        $data['codigo'] = $code;
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

    function getRows($params = array()){
        $this->db->select("*");
        $this->db->from($this->dbTbl);
        
        //fetch data by conditions
        /*if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }*/
        
        //search by terms
        if(!empty($params['searchTerm'])){
            $this->db->like('nombre', $params['searchTerm']);
        }
        
        $this->db->order_by('nombre', 'asc');
        
        if(array_key_exists("codigo",$params)){
            $this->db->where($params['codigo']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }

         //return fetched data
        return $result;
    }
}