<?php

include 'conexion.php';
session_start();
$mysql->Execute("INSERT INTO ancheta (id,sessione_id, presentacion_id, cantidad)VALUES ('','" . session_id() . "', " . $_POST["presentacion"] . "," . $_POST["cantidad"] . ")");
?>