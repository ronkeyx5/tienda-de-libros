<?php
session_start();
require "../conecta.php";

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

$id = $_SESSION['id'];
$id_producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];

$con = conecta();

$sqlCheck = "SELECT * FROM carrito WHERE id_producto='$id_producto' AND id_cliente='$id'";
$resCheck = mysqli_query($con, $sqlCheck);
$numCheck = mysqli_num_rows($resCheck);

if ($numCheck > 0) {
    $cantidadEx = mysqli_result($resCheck, 0, "cantidad");

    $cantidadTotal = $cantidadEx + $cantidad;
    
    echo $cantidadTotal;
    echo $cantidadEx;
    echo $cantidad;

    $sql = "UPDATE carrito SET cantidad='$cantidadTotal' WHERE id_producto='$id_producto' AND id_cliente='$id'";
    $res = mysqli_query($con, $sql);
} else {

    $sql = "INSERT INTO carrito VALUES ('$id', '$id_producto', '$cantidad')";
    $res = mysqli_query($con, $sql);
}
