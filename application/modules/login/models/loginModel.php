<?php
class loginModel extends CI_Model{
function validateUser($email, $pass){
		$sql="select * from usuario where email='".$email."' and clave ='".$pass."'";
		$return = $this->db->query($sql)->num_rows();
		if($return ==0){
			return false;
		}
		else{
			return true;
		}
	}
	function getUserType($email, $pass){
		$this->db->select('tipo');
		$this->db->where('email',$email);
		$this->db->where('clave',$pass);
		$this->db->limit(1);
		$result = $this->db->get('usuario')->result();

		foreach($result as $row){
			return $row->tipo;
		}

/*
		$sql = "select login.perfil from ejemplo.login where nombre='".$usuario."' and clave ='".$clave."'";
		$retorno = $this->db->query($sql);
		*/
	}
}
?>