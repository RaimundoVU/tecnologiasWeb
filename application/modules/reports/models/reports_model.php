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

  public function getReport3()
  {
    $query = 'SELECT usuario.nombres, usuario.apellido_paterno, usuario.apellido_materno, usuario.email, asignatura.nombre , W.semestre, W.anho FROM (SELECT count(T.id_nota) as num_sin_nota, T.id_inst as id_inst , T.id_asig as id_asig, T.id_pro as id_pro, T.semestre as semestre, T.anho as anho FROM (SELECT instancia_asignatura.id as id_inst, evaluacion.id_evaluacion as id_ev, nota.valor as valor , nota.id_nota as id_nota, instancia_asignatura.id_asignatura as id_asig, instancia_asignatura.id_usuario as id_pro, instancia_asignatura.semestre as semestre, instancia_asignatura.anho as anho FROM instancia_asignatura, evaluacion, nota WHERE nota.id_evaluacion = evaluacion.id_evaluacion and evaluacion.id_ins_asignatura = instancia_asignatura.id) as T where T.valor = 0 GROUP BY T.id_inst) as W, asignatura , usuario WHERE W.id_asig = asignatura.id and usuario.id_usuario = W.id_pro and usuario.tipo = 3';
    return $this->db->query($query)->result();
  }
  

  function getSubjectsByCant($cant)
  {
      $query = "SELECT * FROM asignatura, (SELECT instancia_asignatura.id as id_ins, instancia_asignatura.id_asignatura as id_asig, instancia_asignatura.semestre as sem, instancia_asignatura.anho as anho, count(estudiante.matricula) as cant FROM instancia_asignatura, asignatura_estudiante, estudiante where instancia_asignatura.id = asignatura_estudiante.id_instancia_asignatura and estudiante.matricula = asignatura_estudiante.id_estudiante GROUP BY instancia_asignatura.id) as t1 WHERE asignatura.id = t1.id_asig and t1.cant>".$cant.";";
      
      return $this->db->query($query)->result();
  }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */