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

    function getEvaluationsAway($userEmail,$dateAway)
    {
        $query = "select evaluacion.topico,evaluacion.fecha,asignatura.nombre From evaluacion,instancia_asignatura,usuario,asignatura WHERE instancia_asignatura.id_usuario = usuario.id_usuario AND 
        evaluacion.id_ins_asignatura=instancia_asignatura.id AND asignatura.id =  instancia_asignatura.id_asignatura AND usuario.email = '$userEmail' AND evaluacion.fecha = '$dateAway'";
        
        return $this->db->query($query)->result();
    }

    function getEvaluationsAgo($userEmail,$dateAgo)
    {
        $query = "select evaluacion.topico,evaluacion.fecha, asignatura.nombre From evaluacion,instancia_asignatura,usuario,asignatura WHERE instancia_asignatura.id_usuario = usuario.id_usuario AND 
        evaluacion.id_ins_asignatura=instancia_asignatura.id AND asignatura.id =  instancia_asignatura.id_asignatura AND usuario.email = '$userEmail' AND evaluacion.fecha = '$dateAgo'";
        return $this->db->query($query)->result();
    }
 

}
?>