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

  public function getSubjectAverage()
    {
        
        $query = "select AVG(nota.valor) as promedio, instancia_asignatura.semestre as semestre, 
        instancia_asignatura.anho as anho ,asignatura.nombre 
        FROM instancia_asignatura,asignatura,nota,evaluacion 
        WHERE instancia_asignatura.id_asignatura=asignatura.id 
        and evaluacion.id_ins_asignatura=instancia_asignatura.id and nota.id_evaluacion = evaluacion.id_evaluacion 
        GROUP BY(instancia_asignatura.id)";
        return $this->db->query($query)->result();
        
    }

  public function report4($quantity)
  {
      $query = "select cantidad, semestre,anho,nombre from (select COUNT(estudiante.matricula) as cantidad, 
      instancia_asignatura.semestre as semestre,instancia_asignatura.anho as anho,asignatura.nombre as nombre 
      FROM estudiante,instancia_asignatura,asignatura,asignatura_estudiante 
      where instancia_asignatura.id_asignatura = asignatura.id and 
      estudiante.matricula = asignatura_estudiante.id_estudiante and 
      instancia_asignatura.id = asignatura_estudiante.id_instancia_asignatura GROUP BY(instancia_asignatura.id)) as 
      asignaturas where cantidad >'$quantity'";
      return $this->db->query($query)->result();
  }
  
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */