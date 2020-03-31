<?php
session_start();
require "../conecta.php";


$con = conecta();

$id = $_SESSION['id'];
$id_producto = $_POST['producto'];

$sql = "DELETE FROM carrito WHERE id_cliente='$id' AND id_producto='$id_producto'";
$res = mysqli_query($con, $sql);

return true;

?>