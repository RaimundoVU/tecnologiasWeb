<?php
class gradeModel extends CI_Model{

    function getGrades($idEvaluation, $idSubject) {
        $query= "SELECT matricula, nombre, apellido_paterno, apellido_materno, valor, observacion FROM nota, estudiante WHERE id_evaluacion= ".$idEvaluation." AND estudiante.matricula = nota.matricula_estudiante";
        $result = $this->db->query($query);
        if ( $result->num_rows() == 0) {
            $queryStudents = "SELECT * FROM asignatura_estudiante WHERE id_instancia_asignatura = ".$idSubject;
            $students = $this->db->query($queryStudents)->result();
            foreach($students as $student) {
                $addStudentQuery = "INSERT INTO nota (observacion, valor, matricula_estudiante, id_evaluacion) VALUES ('',0,'".$student->id_estudiante."',".$idEvaluation.")";
                $this->db->query($addStudentQuery);
            }
        }
        return $this->db->query($query)->result();
    }

    function getEvaluation($idEvaluation) {
        $query= "SELECT *  FROM evaluacion WHERE id_evaluacion= ".$idEvaluation;
        return $this->db->query($query)->result();
    }


    function updateGrade($grade, $obs, $matricula, $idEvaluation) {
        $query= "UPDATE nota SET valor = '".$grade."', observacion = '".$obs."' WHERE matricula_estudiante = ".$matricula." AND id_evaluacion =".$idEvaluation;
        return $this->db->query($query);
    }

}
?>