<?php
class uploadifiveController {

	public $valor;
	public $obj;

	public function __construct(){
		//include_once("model/uploadifiveModel.php");
		//$obj = new uploadifiveModel();
	}

	public function index(){
		$nosuben = array('php','php3','php4','phtml','phtm','exe','htm','html','asp','xml','sh','bin');
		$verifyToken = md5(FIRMA.$_POST['timestamp']);
		if(!empty($_FILES) && $_POST['token']==$verifyToken){
			$tempFile=$_FILES['Filedata']['tmp_name'];
			$targetFile=TEMP.$verifyToken.$_FILES['Filedata']['name'];
			$fileParts=pathinfo($_FILES['Filedata']['name']);
			if(!in_array(strtolower($fileParts['extension']),$nosuben)){
				move_uploaded_file($tempFile, $targetFile);
				echo $_FILES['Filedata']['type'];
			}else{echo '0';}
		}else{
			echo 'error de validacion';
		}
		exit;
	}

	public function existe(){
		$fn=limpia($_POST['filename']);
		echo (file_exists(TEMP.$fn))?'1':'0';
		exit;
	}

}

