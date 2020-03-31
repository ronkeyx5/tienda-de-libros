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

if ($cantidad > 0) {
    echo "this";
    $sql = "UPDATE carrito SET cantidad='$cantidad' WHERE id_producto='$id_producto' AND id_cliente='$id'";
    $res = mysqli_query($con, $sql);
    echo $sql;

} else {
    echo "this2";
    $sql = "DELETE FROM carrito WHERE id_cliente='$id' AND id_producto='$id_producto'";
    $res = mysqli_query($con, $sql);

    echo $res + $id + $id_producto;
}
