<?php
class anchetaModel {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count(ancheta.id) as son FROM ancheta";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT ancheta.*, sessiones.nombre as sessiones_nombre, productos.nombre as productos_nombre
			FROM ancheta
			LEFT JOIN sessiones ON ancheta.sessione_id=sessiones.id
			LEFT JOIN productos ON ancheta.producto_id=productos.id
			WHERE ancheta.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT ancheta.*, sessiones.nombre as sessiones_nombre, productos.nombre as productos_nombre
			FROM ancheta
			LEFT JOIN sessiones ON ancheta.sessione_id=sessiones.id
			LEFT JOIN productos ON ancheta.producto_id=productos.id
			WHERE ancheta.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT ancheta.*, sessiones.nombre as sessiones_nombre, productos.nombre as productos_nombre
			FROM ancheta
			LEFT JOIN sessiones ON ancheta.sessione_id=sessiones.id
			LEFT JOIN productos ON ancheta.producto_id=productos.id
			";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT ancheta.*, sessiones.nombre as sessiones_nombre, productos.nombre as productos_nombre
			FROM ancheta 
			LEFT JOIN sessiones ON ancheta.sessione_id=sessiones.id
			LEFT JOIN productos ON ancheta.producto_id=productos.id
			WHERE ancheta.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
		if(isset($llega["sessione_id"]) && $llega["sessione_id"]!=0 && $llega["sessione_id"]!="")
			$where.="ancheta.sessione_id = ".$llega["sessione_id"]." AND ";
 		if(isset($llega["producto_id"]) && $llega["producto_id"]!=0 && $llega["producto_id"]!="")
			$where.="ancheta.producto_id = ".$llega["producto_id"]." AND ";
 
		$sql="
			SELECT ancheta.*, sessiones.nombre as sessiones_nombre, productos.nombre as productos_nombre
			FROM ancheta
			LEFT JOIN sessiones ON ancheta.sessione_id=sessiones.id
			LEFT JOIN productos ON ancheta.producto_id=productos.id
			
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("ancheta",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT ancheta.*, sessiones.nombre as sessiones_nombre, productos.nombre as productos_nombre
			FROM ancheta 
			LEFT JOIN sessiones ON ancheta.sessione_id=sessiones.id
			LEFT JOIN productos ON ancheta.producto_id=productos.id
			WHERE ancheta.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("ancheta",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM ancheta WHERE id=".$id);
	}


}

