<?php
session_start();

require "../conecta.php";
$con = conecta();

$id = $_GET['id'];
$status = $_GET['status'];

if($status=="Procesando") {
    $sql = "UPDATE envio SET estado=\"Entregado\" WHERE id_transaccion='$id'";
} else{
    $sql = "UPDATE envio SET estado=\"Procesando\" WHERE id_transaccion='$id'";
}

$res = mysqli_query($con, $sql);

header("Location: tabla-mostrar-pedidos.php");

?>
