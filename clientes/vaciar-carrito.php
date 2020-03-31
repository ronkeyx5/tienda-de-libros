<?php
session_start();
require "../conecta.php";

$con = conecta();
$id = $_SESSION['id'];

$sql = "DELETE FROM carrito WHERE id_cliente='$id'";
$res = mysqli_query($con, $sql);

header ("Location: home.php");

?>