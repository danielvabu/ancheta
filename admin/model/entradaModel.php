<?php
class entradaModel{

	public $db;
	public $tabla;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function verificar($user,$clave){
		$sql = "SELECT * FROM ".$this->tabla." WHERE email='".$user."' AND clave='".$clave."' AND estado>=0 ";
		return $this->db->Execute($sql);
	}

	public function verificarADM($user,$clave){
		$sql = "SELECT * FROM admins WHERE usuario='".$user."' AND clave='".$clave."' AND estado>=0 ";
		return $this->db->Execute($sql);
	}

	public function verificacookie($id,$email){
		$sql = "SELECT * FROM ".$this->tabla." WHERE id='".$id."' AND email='".$email."' AND estado>=0 ";
		return $this->db->Execute($sql);
	}

	public function verificaEmail($a){
		$sql = "SELECT count(id) as cuantos FROM ".$this->tabla." WHERE email='".$a."'";
		$sale=$this->db->Execute($sql);
		return $sale->fields['cuantos'];
	}

	public function olvidopass($a){
		$sql = "SELECT nombre, clave FROM ".$this->tabla." WHERE email='".$a."'";
		return $this->db->Execute($sql);
	}

	public function registrando($entra){
		if($this->db->AutoExecute($this->tabla,$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute($this->tabla,$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function fbverifica($a){
		$sql = "SELECT * FROM ".$this->tabla." WHERE fbid='".$a."'";
		return $this->db->Execute($sql);
	}

	public function fbverificamail($a){
		$sql = "SELECT id FROM ".$this->tabla." WHERE email='".$a."'";
		return $this->db->Execute($sql);
	}


}	
