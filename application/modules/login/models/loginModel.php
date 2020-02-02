<?php
class loginModel extends CI_Model{
function validarUsuario($correo, $clave){
		$sql="select * from usuario where email='".$correo."' and clave ='".$clave."'";
		$retorno = $this->db->query($sql)->num_rows();
		if($retorno ==0){
			return false;
		}
		else{
			return true;
		}
	}
}
?>