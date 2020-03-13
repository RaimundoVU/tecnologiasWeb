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
    return;
  }

  public function add_student($data)
  {
    $this->db->insert('estudiante',$data);
  }
  public function add_student_in_subject($data)
  {
    $this->db->insert('asignatura_estudiante',$data);
  }

  public function check($matricula)
  {
    $query = $this->db->get_where('estudiante', array(
      'matricula' => $matricula
    ));
    $count = $query->num_rows();
    return $count === 0;
  }
  public function check_evaluation($id_subject)
  {
    $query = $this->db->get_where('evaluacion', array(
      'id_ins_asignatura' => $id_subject
    ));
    $count = $query->num_rows();
    return $count === 0;
  }
  public function add_nota($id_subject, $matricula){
    $this->db->select('*');
    $this->db->from('evaluacion');
    $this->db->where('id_ins_asignatura', $id_subject);var_dump('hola1');

    $query = $this->db->get();    
    if ($query->num_rows() > 0) {
      var_dump('igggg');
      foreach ($query->result() as $row) {
        var_dump('hola');
        $data = [
          'observacion' => '',
          'valor' => 0,
          'matricula_estudiante' => $matricula,
          'id_evaluacion' => $row->id_evaluacion
        ];
        $this->db->insert('nota', $data);
      }
    }
    
  }
  public function check_student_in_subject($data)
  {
    $query = $this->db->get_where('asignatura_estudiante', [
        'id_estudiante' => $data['id_estudiante'],
        'id_instancia_asignatura' => $data['id_instancia_asignatura']
    ]);
    $count = $query->num_rows();
    return $count === 0;
  }

  public function update_student($matricula, $data)
  {
    $this->db->where('matricula', $matricula);
    $this->db->update('estudiante', $data);
  }
  
  public function get_students_in_subject($id_ins)
  {
    $this->db->select('*');
    $this->db->from('estudiante');
    $this->db->join('asignatura_estudiante', 'estudiante.matricula=asignatura_estudiante.id_estudiante', 'inner');
    $this->db->where('asignatura_estudiante.id_instancia_asignatura', $id_ins);
    $query = $this->db->get();    
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return [];
  }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */