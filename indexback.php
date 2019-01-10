<?php

require_once('admin/inc/adodb5/adodb.inc.php');
require_once('admin/inc/class.phpmailer.php');
include_once('admin/inc/config_raiz.php');
include_once('admin/inc/funciones.php');

session_start();

class nada {

    public $EOF = 1;

    public function index() {
        echo '';
    }

}

if (!isset($_SESSION['JC_Idioma'])) {
    $_SESSION['JC_Idioma'] = IDIOMA;
}

$datos = explode('/', limpia(str_replace(PATO, '', $_SERVER['REQUEST_URI'])));
$valor = Array();
if ($datos[0] != '' && substr($datos[0], 0, 1) != '?') {
    define('MODULO', $datos[0]);
} else {
    define('MODULO', 'index');
}
if (isset($datos[1]) && $datos[1] != '' && substr($datos[1], 0, 1) != '?') {
    define('PROCESO', $datos[1]);
} else {
    define('PROCESO', 'index');
}
$fin = count($datos);
if ($fin > 2) {
    if (substr($datos[2], 0, 1) != '?') {
        $j = 0;
        for ($i = 2; $i < $fin; $i++) {
            if (!empty($datos[$i])) {
                $valor[$j++] = $datos[$i];
            }
        }
    }
}

include_once('admin/inc/db.php');
include_once('admin/controller/baseControl.php');

//include_once('admin/inc/facebook.php');$facebook=new Facebook(array('appId'=>YOUR_APP_ID,'secret'=>YOUR_SECRET));$userId=$facebook->getUser();

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start("ob_gzhandler");
} else {
    ob_start();
}
if (!is_file('controller/' . MODULO . 'Controller.php')) {
    include_once('controller/indexController.php');
    $a = new indexController();
    $a->valor = $valor;
    $a->cuatrocerocuatro();
} else {
    include_once('controller/' . MODULO . 'Controller.php');
    eval('$a = new ' . MODULO . 'Controller();');
    $a->valor = $valor;
    if (method_exists($a, PROCESO)) {
        eval('$a->' . PROCESO . '();');
    } else {
        $a->cuatrocerocuatro();
    }
}
ob_flush();
