<?php
class EvaluationModel extends CI_Model{

    function getEvaluations($idSubject){
        $query= "SELECT * FROM evaluacion WHERE id_ins_asignatura = ".$idSubject." ORDER BY fecha DESC";
        return $this->db->query($query)->result();
    }

    function saveEvaluation($title, $description, $date, $idSubject) {
        $query= "INSERT INTO evaluacion (topico, descripcion, fecha, id_ins_asignatura) VALUES ('".$title."','".$description."','".$date."',".$idSubject.")";
        return $this->db->query($query);
    }

    function updateEvaluation($title, $description, $date, $idEvaluation) {
        $query= "UPDATE evaluacion SET topico = '".$title."', descripcion = '".$description."', fecha = '".$date."' WHERE id_evaluacion = ".$idEvaluation;
        return $this->db->query($query);
    }

}
?>