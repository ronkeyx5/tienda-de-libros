<?php
session_start();

$_SESSION["migrarCarrito"]=1;
$_SESSION["idMigracion"]=$_SESSION["id"];

header("Location: login.php");

?>