<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_instance_model extends CI_Model
{
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
    $sql = "Select asignatura.nombre as nombre, asignatura.codigo as codigo, instancia_asignatura.anho as
        anho,instancia_asignatura.semestre as semestre,instancia_asignatura.id as id From asignatura,instancia_asignatura,usuario WHERE instancia_asignatura.id_usuario = usuario.id_usuario AND 
        instancia_asignatura.id_asignatura = asignatura.id AND usuario.email = '$email'";
    return $this->db->query($sql)->result();
  }

  public function get_subject($id)
  {
    $query = "SELECT instancia_asignatura.anho as anho, instancia_asignatura.semestre as 
      semestre, usuario.nombres as nombres, usuario.apellido_paterno as apellido_paterno, usuario.apellido_materno as apellido_materno, asignatura.nombre as asignatura
       FROM instancia_asignatura, usuario,asignatura WHERE instancia_asignatura.id = '$id' AND usuario.id_usuario = instancia_asignatura.id_usuario AND instancia_asignatura.id_asignatura = asignatura.id";
    return $this->db->query($query)->result()[0];
  }

  public function get_all_instances()
  {

    $this->db->select('asignatura.nombre, instancia_asignatura.id, instancia_asignatura.semestre, instancia_asignatura.anho, asignatura.codigo, usuario.nombres, usuario.apellido_paterno, usuario.apellido_materno');
    $this->db->from('asignatura');
    $this->db->join('instancia_asignatura', 'instancia_asignatura.id_asignatura = asignatura.id');
    $this->db->join('usuario', 'instancia_asignatura.id_usuario = usuario.id_usuario');
    return $this->db->get()->result();
    //$this->db->select('*');
    //$this->db->get('instancia_asignatura')->result();
  }

  public function add($code, $semester, $professor_id, $year)
  {
    $data['id_asignatura'] = $code;
    $data['semestre'] = $semester;
    $data['id_usuario'] = $professor_id;
    $data['anho'] = $year;
    $this->db->insert('instancia_asignatura', $data);
  }

  public function get_teacher_id($email)
  {

    $this->db->select('id_usuario');
    $this->db->where('email', $email);
    $result = $this->db->get('usuario')->result();
    //echo ($result);
    foreach ($result as $row) {
      return $row->id_usuario;
    }
  }




  public function get_subject_id($id)
  {
    $this->db->select('asignatura.nombre , asignatura.codigo, instancia_asignatura.anho, instancia_asignatura.semestre, instancia_asignatura.id');
    $this->db->from('asignatura, instancia_asignatura');
    $this->db->where('asignatura.id = ' . $id . ' and instancia_asignatura.id_asignatura = ' . $id);
    return $this->db->get()->result();
  }

  public function check($codigo, $nombre)
  {
    $query = $this->db->get_where('asignatura', array(
      'codigo' => $codigo,
      'nombre' => $nombre
    ));
    $count = $query->num_rows();
    return $count === 0;
  }


  public function get_id_subject($codigo, $nombre)
  {
    $this->db->select('*');
    $result = $this->db->get_where('asignatura', array(
      'codigo' => $codigo,
      'nombre' => $nombre
    ))->result();

    foreach ($result as $row) {
      return $row->id;
    }
  }

  function getRows($searchValue)
  {
    $query = "SELECT * FROM (SELECT asignatura.nombre as nombre, instancia_asignatura.id as id, instancia_asignatura.semestre as semestre,
      instancia_asignatura.anho as anio FROM asignatura, instancia_asignatura) AS T1  WHERE T1.nombre LIKE '%" . $searchValue . "%'";

    return $this->db->query($query)->result_array();
  }

  function getNUmbersStudnetsWithoutGradeByEvaluation($id)
  {
      $query = 'SELECT count(T.id_nota) as num_sin_nota , T.id_inst , T.id_ev ,T.id_asig, T.fecha_ev, T.titulo, T.semestre, T.anho, asignatura.nombre FROM asignatura, (SELECT instancia_asignatura.id as id_inst, evaluacion.id_evaluacion as id_ev, nota.valor as valor , nota.id_nota as id_nota, instancia_asignatura.semestre as semestre, instancia_asignatura.anho as anho, evaluacion.fecha as fecha_ev, evaluacion.topico as titulo, instancia_asignatura.id_asignatura as id_asig FROM instancia_asignatura, evaluacion, nota WHERE nota.id_evaluacion = evaluacion.id_evaluacion and evaluacion.id_ins_asignatura = instancia_asignatura.id) as T where T.valor = 0 and T.id_inst = '.$id.' and T.id_asig = asignatura.id GROUP BY T.id_ev';
      return $this->db->query($query)->result();
  }



  public function getSubjectByIdInstance($id)
  {
      $query = 'SELECT asignatura.nombre , asignatura.codigo, instancia_asignatura.semestre, instancia_asignatura.anho FROM asignatura, instancia_asignatura WHERE instancia_asignatura.id = '.$id.' and asignatura.id = instancia_asignatura.id_asignatura';
      return $this->db->query($query)->result();
  }


 



}
