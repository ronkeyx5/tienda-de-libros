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

$con = conecta();

$sqlCheck = "SELECT * FROM carrito WHERE id_cliente='$id'";
$resCheck = mysqli_query($con, $sqlCheck);
$numCheck = mysqli_num_rows($resCheck);

if ($numCheck > 0) {
    $sql = "INSERT INTO pedidos VALUES (0, now(), '$id', 0)";
    $res = mysqli_query($con, $sql);

    $id_pedido = mysqli_insert_id($con);

    for ($i=0; $i<$numCheck; $i++) {
        $id_producto = mysqli_result($resCheck, $i, "id_producto");
        $id_cliente = mysqli_result($resCheck, $i, "id_cliente");
        $cantidad = mysqli_result($resCheck, $i, "cantidad");

        $sql2 = "INSERT INTO pedidos_productos VALUES (0, '$id_pedido', '$id_producto', '$cantidad')";
        $res2 = mysqli_query($con, $sql2);
    }

    $sql3 = "DELETE FROM carrito WHERE id_cliente='$id'";
    mysqli_query($con, $sql3);
}

header ("Location: home.php");
