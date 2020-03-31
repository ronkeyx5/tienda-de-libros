<?php
session_start();

require "../conecta.php";
$con = conecta();

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$encPass = md5($pass);

$sql = "INSERT INTO clientes VALUES (0, '$nombre', '$apellidos', '$correo', '$encPass', 1, 0)";
$res = mysqli_query($con, $sql);

$_SESSION['created']=1;

echo "<br> $nombre";

//header("Location: lista_administradores.php");
?>