<?php
class enumvaluesModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(enumvalues.id) as son FROM enumvalues";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT enumvalues.*
			FROM enumvalues
			WHERE enumvalues.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT enumvalues.*
			FROM enumvalues
			WHERE enumvalues.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT enumvalues.*
			FROM enumvalues
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT enumvalues.*
			FROM enumvalues 
			WHERE enumvalues.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";

		$sql="
			SELECT enumvalues.*
			FROM enumvalues
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("enumvalues",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT enumvalues.*
			FROM enumvalues 
			WHERE enumvalues.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("enumvalues",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM enumvalues WHERE id=".$id);
	}


}

