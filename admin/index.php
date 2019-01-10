<?php

session_start();

if(!isset($_SESSION['JC_PaisJX'])){$_SESSION['JC_PaisJX']='colombia';}
if(isset($_POST['pais']) && $_POST['pais']!=''){$_SESSION['JC_PaisJX']=$_POST['pais'];}

require_once('inc/adodb5/adodb.inc.php');require_once('inc/class.phpmailer.php');require_once('inc/config.php');require_once('inc/db.php');
class nada{public $EOF=1;public function index(){echo '';}}
if(!isset($_SESSION['JC_Idioma'])){$_SESSION['JC_Idioma']=IDIOMA;}

require_once('controller/baseControl.php');require_once('inc/funciones.php');

$datos = explode('/',limpia(str_replace(PATO,'',$_SERVER['REQUEST_URI'])));$valor = Array();
if($datos[0]!=''&&substr($datos[0],0,1)!='?'){define('MODULO',$datos[0]);}else{define('MODULO','index');}
if(isset($datos[1])&&$datos[1]!=''&&substr($datos[1],0,1)!='?'){define('PROCESO',$datos[1]);}else{define('PROCESO','index');}
$fin=count($datos);if($fin>2){if(substr($datos[2],0,1)!='?'){$j=0;for($i=2;$i<$fin;$i++){if(!empty($datos[$i])){$valor[$j++]=$datos[$i];}}}}
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){ob_start("ob_gzhandler");}else{ob_start();}
include_once('controller/'.MODULO.'Controller.php');eval('$a = new '.MODULO.'Controller();');$a->valor=$valor;eval('$a->'.PROCESO.'();');
ob_flush();
