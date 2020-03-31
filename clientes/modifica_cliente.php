<?php
session_start();

require "../conecta.php";
$con = conecta();

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$id = $_POST['id'];

$sql = "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos', correo='$correo' WHERE id='$id'";
$res = mysqli_query($con, $sql);
echo "Finish";
