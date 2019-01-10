<?php
class mailsController {

	public $valor;

	public function __construct(){
		include('view/mails_header.php');
	}

	public function index(){
		include('view/mails_index.php');
		include('view/mails_footer.php');
	}

	public function alta(){
		include('view/mails_alta.php');
		include('view/mails_footer.php');
	}

	public function recordar(){
		include('view/mails_recordar.php');
		include('view/mails_footer.php');
	}

	public function contacto(){
		include('view/mails_contacto.php');
		include('view/mails_footer.php');
	}


}

