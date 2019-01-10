<?php
class typesModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(types.id) as son FROM types";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT types.*
			FROM types
			WHERE types.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT types.*
			FROM types
			WHERE types.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT types.*
			FROM types
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT types.*
			FROM types 
			WHERE types.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";

		$sql="
			SELECT types.*
			FROM types
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("types",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT types.*
			FROM types 
			WHERE types.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("types",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM types WHERE id=".$id);
	}


}

