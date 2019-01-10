<?php
class departamentosModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(departamentos.id) as son FROM departamentos";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT departamentos.*
			FROM departamentos
			WHERE departamentos.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT departamentos.*
			FROM departamentos
			WHERE departamentos.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT departamentos.*
			FROM departamentos
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT departamentos.*
			FROM departamentos 
			WHERE departamentos.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["estado"]) && $llega["estado"]!=-1)
			$where.="departamentos.estado = ".$llega["estado"]." AND ";
 
		$sql="
			SELECT departamentos.*
			FROM departamentos
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("departamentos",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT departamentos.*
			FROM departamentos 
			WHERE departamentos.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("departamentos",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM departamentos WHERE id=".$id);
	}


}

