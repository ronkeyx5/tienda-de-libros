<?php
session_start();
require "../conecta.php";

function carritoCount()
{
    $con = conecta();
    $id = $_SESSION['id'];

    $sql = "SELECT * FROM carrito WHERE id_cliente='$id'";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    if ($num > 0) {
        return $num;
    } else {
        return 0;
    }
}
