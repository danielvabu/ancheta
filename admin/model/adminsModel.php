<?php
class adminsModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(admins.id) as son FROM admins";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function listar(){
		$sql="
			SELECT admins.*
			FROM admins
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT admins.*
			FROM admins 
			WHERE admins.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["nombre"]) && $llega["nombre"]!="")
			$where.="admins.nombre REGEXP '".$llega["nombre"]."' AND ";
 		if(isset($llega["email"]) && $llega["email"]!="")
			$where.="admins.email REGEXP '".$llega["email"]."' AND ";
 		if(isset($llega["usuario"]) && $llega["usuario"]!="")
			$where.="admins.usuario REGEXP '".$llega["usuario"]."' AND ";
 		if(isset($llega["estado"]) && $llega["estado"]!=-1)
			$where.="admins.estado = ".$llega["estado"]." AND ";
 
		$sql="
			SELECT admins.*
			FROM admins
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("admins",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT admins.*
			FROM admins 
			WHERE admins.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("admins",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM admins WHERE id=".$id);
	}


}

