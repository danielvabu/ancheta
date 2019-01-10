<?php
class ajaxController extends baseControl {

	public $valor;
	public $pro;

	public function __construct(){
		include_once("model/indexModel.php");
		include_once("model/entradaModel.php");$this->entra = new entradaModel();
	}

	public function fb(){
		/*
		accessToken
		userID
		expiresIn
		signedRequest
		*/
		if(isset($_COOKIE['email']) && $_COOKIE['email']!='' && !isset($_SESSION['JC_UserID'])){
			$llave = crypt($_COOKIE['id'].'~'.FIRMA.'~'.$_COOKIE['email'], 'rl');
			if($_COOKIE['carpeta']=='personas'){
				if($_COOKIE['llave']==$llave){
					$rs = $this->entra->verificacookie($_COOKIE['id'],$_COOKIE['email']);
					if(!$rs->EOF){
						$_SESSION['JC_UserID'] = $rs->fields['id'];
						$_SESSION['JC_Nombre'] = $rs->fields['nombre'];
						$_SESSION['JC_Email'] = $rs->fields['email'];
						$_SESSION['JC_Grupo'] = "personas";
						$_SESSION['JC_Estado'] = $rs->fields['estado'];
						$llave = crypt($_SESSION['JC_UserID'].'~'.FIRMA.'~'.$_SESSION['JC_Email'], 'rl');
						setcookie("id", $_SESSION['JC_UserID'], time()+60*60*24*15, PATO);
						setcookie("email", $_SESSION['JC_Email'], time()+60*60*24*15, PATO);
						setcookie("carpeta", 'personas', time()+60*60*24*15, PATO);
						setcookie("llave", $llave, time()+60*60*24*15, PATO);
						header("Location: ".PATO);
					}
				}
			}
			if($_COOKIE['carpeta']=='consultores'){header("Location: ".PATO."consultores/");exit;}
		}
		$timestamp = time();
		$unique_salt = md5(FIRMA.$timestamp);
		include_once("model/departamentosModel.php");$departamentoobj = new departamentosModel();
		$departamentos = $departamentoobj->listar();
		include('view/_header.php');
		if(ifaut()){include('view/index_interno.php');}else{include('view/index_index.php');}
		include('view/_footer.php');
	}


}

