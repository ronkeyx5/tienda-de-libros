<?php
session_start();

require "conecta.php";

$con = conecta();

$correo = $_POST['email'];
$pass = $_POST['password'];
$encPass = md5($pass);

$sql = "SELECT * FROM administradores WHERE correo = '" . $correo . "' AND pass = '" . $encPass . "'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

/*?> <script>console.log("<?php echo $num; ?> ");</script> <?php*/

if ($num != 0) {
    $id = mysqli_result($res, 0, 'id');
    $nombre = mysqli_result($res, 0, 'nombre');
    $rol = mysqli_result($res, 0, 'rol');
    $pic = mysqli_result($res, 0, 'archivo_n');

    $_SESSION["id"] = $id;
    $_SESSION["nombre"] = $nombre;
    $_SESSION["rol"] = $rol;
    $_SESSION["pic"] = $pic;
    $_SESSION['type'] = 1;
    return;
} else {
    $_SESSION["id"] = -1;
}

$sql = "SELECT * FROM clientes WHERE correo = '" . $correo . "' AND pass = '" . $encPass . "'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if ($num != 0) {
    $id = mysqli_result($res, 0, 'id');
    $nombre = mysqli_result($res, 0, 'nombre');

    $_SESSION["id"] = $id;
    $_SESSION["nombre"] = $nombre;
    $_SESSION['type'] = 2;
    return;
} else {
    $_SESSION["id"] = -1;
}

function mysqli_result($res, $row, $field=0)    {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

?>