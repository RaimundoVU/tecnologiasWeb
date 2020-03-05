<?php
class EvaluationModel extends CI_Model{

    function getEvaluations($idSubject){
        $query= "SELECT * FROM evaluacion WHERE codigo_asignatura = ".$idSubject." ORDER BY fecha DESC";
        return $this->db->query($query)->result();
    }
    function calcularLineas(){
        $query= "SELECT COUNT(*) AS cantidad FROM usuario";
		return $this->db->query($query)->result();
    }

}
?>