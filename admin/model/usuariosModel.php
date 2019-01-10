<?php
class usuariosModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(usuarios.id) as son FROM usuarios";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT usuarios.*
			FROM usuarios
			WHERE usuarios.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT usuarios.*
			FROM usuarios
			WHERE usuarios.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT usuarios.*
			FROM usuarios
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT usuarios.*
			FROM usuarios 
			WHERE usuarios.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["old_id"]) && $llega["old_id"]!=0 && $llega["old_id"]!="")
			$where.="usuarios.old_id = ".$llega["old_id"]." AND ";
 		if(isset($llega["constructora_id"]) && $llega["constructora_id"]!=0 && $llega["constructora_id"]!="")
			$where.="usuarios.constructora_id = ".$llega["constructora_id"]." AND ";
 		if(isset($llega["inmobiliaria_id"]) && $llega["inmobiliaria_id"]!=0 && $llega["inmobiliaria_id"]!="")
			$where.="usuarios.inmobiliaria_id = ".$llega["inmobiliaria_id"]." AND ";
 		if(isset($llega["email"]) && $llega["email"]!="")
			$where.="usuarios.email REGEXP '".$llega["email"]."' AND ";
 		if(isset($llega["nombre"]) && $llega["nombre"]!="")
			$where.="usuarios.nombre REGEXP '".$llega["nombre"]."' AND ";
 		if(isset($llega["departamento_id"]) && $llega["departamento_id"]!=0 && $llega["departamento_id"]!="")
			$where.="usuarios.departamento_id = ".$llega["departamento_id"]." AND ";
 		if(isset($llega["ciudad_id"]) && $llega["ciudad_id"]!=0 && $llega["ciudad_id"]!="")
			$where.="usuarios.ciudad_id = ".$llega["ciudad_id"]." AND ";
 		if(isset($llega["estado"]) && $llega["estado"]!=-1)
			$where.="usuarios.estado = ".$llega["estado"]." AND ";
 		if(isset($llega["biguser_id"]) && $llega["biguser_id"]!=0 && $llega["biguser_id"]!="")
			$where.="usuarios.biguser_id = ".$llega["biguser_id"]." AND ";
 
		$sql="
			SELECT usuarios.*
			FROM usuarios
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("usuarios",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT usuarios.*
			FROM usuarios 
			WHERE usuarios.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("usuarios",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM usuarios WHERE id=".$id);
	}


}

