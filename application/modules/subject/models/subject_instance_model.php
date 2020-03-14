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
        $sql= "Select asignatura.nombre as nombre, asignatura.codigo as codigo, instancia_asignatura.anho as
        anho,instancia_asignatura.semestre as semestre,instancia_asignatura.id as id From asignatura,instancia_asignatura,usuario WHERE instancia_asignatura.id_usuario = usuario.id_usuario AND 
        instancia_asignatura.id_asignatura = asignatura.id AND usuario.email = '$email'";
        return $this->db->query($sql)->result();
    }

    public function get_all_instances() 
    {

      $this->db->select('instancia_asignatura.id, asignatura.nombre, instancia_asignatura.semestre, instancia_asignatura.anho, asignatura.codigo, usuario.nombres, usuario.apellido_paterno, usuario.apellido_materno');
      $this->db->from('asignatura');
      $this->db->join('instancia_asignatura', 'instancia_asignatura.id_asignatura = asignatura.id');
      $this->db->join('usuario', 'instancia_asignatura.id_usuario = usuario.id_usuario');
      return $this->db->get()->result();
      //$this->db->select('*');
      //$this->db->get('instancia_asignatura')->result();
    }

    public function add($code,$semester,$professor_id,$year)
    {
        $data['id_asignatura'] = $code;
        $data['semestre']= $semester;
        $data['id_usuario']= $professor_id;
        $data['anho'] = $year;
        $this->db->insert('instancia_asignatura',$data);
    }

    public function get_teacher_id($email)
    {
          
          $this->db->select('id_usuario');
          $this->db->where('email',$email);
          $result = $this->db->get('usuario')->result();
          //echo ($result);
          foreach($result as $row){
              return $row->id_usuario;
          }
    }

}