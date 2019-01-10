<?php
class indexModel{

	public $db;

	function __construct() {
		$this->db=ADONewConnection(DB_TIPO);$this->db->debug=DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function verificar($email,$passw){
		$result = $this->db->Execute("SELECT * FROM admins WHERE email = '$email' and pass = '$passw' ");
		return $result; 			
	}

}

