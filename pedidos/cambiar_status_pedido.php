<?php
session_start();

require "../conecta.php";
$con = conecta();

$id = $_GET['id'];
$status = $_GET['status'];

if($status==0) {
    $sql = "UPDATE pedidos SET status='1' WHERE id='$id'";
} else{
    $sql = "UPDATE pedidos SET status='0' WHERE id='$id'";
}

$res = mysqli_query($con, $sql);

header("Location: tabla-mostrar-pedidos.php");

?>
