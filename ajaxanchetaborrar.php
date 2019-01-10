<?php

include 'conexion.php';
session_start();
$mysql->Execute("DELETE FROM ancheta WHERE sessione_id='" . session_id() . "' AND  presentacion_id=" . $_POST["id"] . "");
?>