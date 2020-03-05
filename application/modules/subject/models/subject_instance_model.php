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
    
    public function get_all($email)
    {
        //$this->db->select('*');
        $sql= "Select asignatura.nombre as nombre, asignatura.codigo as codigo, instancia_asignatura.fecha_creacion as
        fecha From asignatura,instancia_asignatura,usuario WHERE instancia_asignatura.id_profesor = usuario.id_usuario AND 
        instancia_asignatura.codigo_asignatura = asignatura.codigo AND usuario.email = '$email'";
        return $this->db->query($sql)->result();
    }

    public function add($code,$date,$professor_id)
    {
        $data['codigo_asignatura'] = $code;
        $data['fecha']= $date;
        $data['id_profesor']= $professor_id;
        $this->db->insert('instancia_asignatura',$data);
    }

}