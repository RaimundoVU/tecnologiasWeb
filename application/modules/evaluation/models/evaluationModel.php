<?php
class EvaluationModel extends CI_Model{

    function getEvaluations($idSubject){
        $query= "SELECT * FROM evaluacion WHERE codigo_asignatura = ".$idSubject." ORDER BY fecha DESC";
        return $this->db->query($query)->result();
    }

    function saveEvaluation($title, $description, $date, $idSubject) {
        $query= "INSERT INTO evaluacion (titulo, descripcion, fecha, codigo_instancia_asignatura) VALUES (".$title.",".$description.",".$date.",".$idSubject.")";
        return $this->db->query($query)->result();
    }

}
?>