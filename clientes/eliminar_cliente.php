<?php
session_start();

error_reporting(0);
if ($_SESSION["id"] > 0) {
    echo $_SESSION["id"];
} else {
    header("Location: ../login.php");
}

if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 4) {
    header("Location: home.php");
}

require "../conecta.php";

$id = $_POST["id"];

$con = conecta();

$sql = "UPDATE clientes SET status = 0, eliminado = 1 WHERE id =" . $id;
if (mysqli_query($con, $sql)) {
    echo "Eliminado con exito";
} else {
    echo "Error al eliminar";
}
mysqli_close($con);
