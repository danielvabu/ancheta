<?php
class presentacionesModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(presentaciones.id) as son FROM presentaciones";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT presentaciones.*, productos.nombre as productos_nombre
			FROM presentaciones
			LEFT JOIN productos ON presentaciones.producto_id=productos.id
			WHERE presentaciones.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT presentaciones.*, productos.nombre as productos_nombre
			FROM presentaciones
			LEFT JOIN productos ON presentaciones.producto_id=productos.id
			WHERE presentaciones.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT presentaciones.*, productos.nombre as productos_nombre
			FROM presentaciones
			LEFT JOIN productos ON presentaciones.producto_id=productos.id
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT presentaciones.*, productos.nombre as productos_nombre
			FROM presentaciones 
			LEFT JOIN productos ON presentaciones.producto_id=productos.id
			WHERE presentaciones.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["producto_id"]) && $llega["producto_id"]!="")
			$where.="presentaciones.producto_id REGEXP '".$llega["producto_id"]."' AND ";
 
		$sql="
			SELECT presentaciones.*, productos.nombre as productos_nombre
			FROM presentaciones
			LEFT JOIN productos ON presentaciones.producto_id=productos.id
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("presentaciones",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT presentaciones.*, productos.nombre as productos_nombre
			FROM presentaciones 
			LEFT JOIN productos ON presentaciones.producto_id=productos.id
			WHERE presentaciones.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("presentaciones",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM presentaciones WHERE id=".$id);
	}


}

