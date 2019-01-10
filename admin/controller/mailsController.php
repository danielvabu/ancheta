<?php
class mailsController {

	public $valor;

	public function __construct(){
		eval('include_once("model/'.MODULO.'Model.php");');
	}

	public function index(){
		include('view/'.MODULO.'_header.php');
		include('view/'.MODULO.'_'.PROCESO.'.php');
		include('view/'.MODULO.'_footer.php');
	}

	public function alta(){
		include('view/'.MODULO.'_header.php');
		include('view/'.MODULO.'_'.PROCESO.'.php');
		include('view/'.MODULO.'_footer.php');
	}


}

