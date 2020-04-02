<?php
session_start();
require "../conecta.php";
//Eliminar domicilio, envio y metodo de pago de esta compra, sin borrar el carrito.

$con = conecta();

$id_direccion = $_SESSION["id-domicilio"];
$id_envio = $_SESSION["id-envio"];

$sql1 = "DELETE FROM direccion WHERE id='$id_direccion'"; 
$sql2 = "DELETE FROM envio WHERE id='$id_envio'";

mysqli_query($con, $sql1);
mysqli_query($con, $sql2);

header("Location: home.php?pedido=2");

?>