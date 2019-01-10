<?php

include 'admin/inc/adodb5/adodb.inc.php';
$mysql = ADONewConnection('mysqli'); # eg 'mysql' o 'postgres'
$mysql->debug = false;
$mysql->Connect('localhost', 'root', 'pass', 'basedatos');
//$rs = $mysql->Execute('select count(*) as numero from productos LIMIT 10');
// echo $rs->fields["numero"];
?>