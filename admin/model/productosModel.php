<?php
class productosModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(productos.id) as son FROM productos";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT productos.*
			FROM productos
			WHERE productos.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT productos.*
			FROM productos
			WHERE productos.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT productos.*
			FROM productos
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT productos.*
			FROM productos 
			WHERE productos.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["nombre"]) && $llega["nombre"]!="")
			$where.="productos.nombre REGEXP '".$llega["nombre"]."' AND ";
 
		$sql="
			SELECT productos.*
			FROM productos
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("productos",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT productos.*
			FROM productos 
			WHERE productos.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("productos",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM productos WHERE id=".$id);
	}


}

