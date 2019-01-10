<?php

include 'conexion.php';
session_start();
$mysql->Execute("UPDATE sessiones set numero=" . $_POST["numero"] . " WHERE session_id='" . session_id() . "'");
?>
