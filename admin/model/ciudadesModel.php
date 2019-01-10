<?php
class ciudadesModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(ciudades.id) as son FROM ciudades";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT ciudades.*, departamentos.departamento as departamentos_departamento
			FROM ciudades
			LEFT JOIN departamentos ON ciudades.departamento_id=departamentos.id
			WHERE ciudades.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT ciudades.*, departamentos.departamento as departamentos_departamento
			FROM ciudades
			LEFT JOIN departamentos ON ciudades.departamento_id=departamentos.id
			WHERE ciudades.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT ciudades.*, departamentos.departamento as departamentos_departamento
			FROM ciudades
			LEFT JOIN departamentos ON ciudades.departamento_id=departamentos.id
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT ciudades.*, departamentos.departamento as departamentos_departamento
			FROM ciudades 
			LEFT JOIN departamentos ON ciudades.departamento_id=departamentos.id
			WHERE ciudades.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["departamento_id"]) && $llega["departamento_id"]!=0 && $llega["departamento_id"]!="")
			$where.="ciudades.departamento_id = ".$llega["departamento_id"]." AND ";
 		if(isset($llega["estado"]) && $llega["estado"]!=-1)
			$where.="ciudades.estado = ".$llega["estado"]." AND ";
 
		$sql="
			SELECT ciudades.*, departamentos.departamento as departamentos_departamento
			FROM ciudades
			LEFT JOIN departamentos ON ciudades.departamento_id=departamentos.id
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("ciudades",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT ciudades.*, departamentos.departamento as departamentos_departamento
			FROM ciudades 
			LEFT JOIN departamentos ON ciudades.departamento_id=departamentos.id
			WHERE ciudades.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("ciudades",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM ciudades WHERE id=".$id);
	}


}

