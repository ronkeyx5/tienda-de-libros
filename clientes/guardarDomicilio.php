<?php 
session_start();
require "../conecta.php";

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

//Si es a sucursal
if($_POST["tipo"] == "sucursal") {
    $id = $_SESSION["id"];
    $tipo = $_POST["tipo"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email= $_POST["email"];
    $telefono = $_POST["telefono"];
    $observaciones = $_POST["detalles"];

    $con = conecta();
    
    //Insert a Domicilio, tipo = sucursal
    $sql = "INSERT INTO direccion (id, user_id, tipo, nombre, apellidos, email, telefono, observaciones) VALUES (0, $id, '$tipo', '$nombre', '$apellidos', '$email', '$telefono', '$observaciones')";
    $res = mysqli_query($con, $sql);

    //Last ID
    $lastId = mysqli_insert_id($con);

    $_SESSION["id-domicilio"]=$lastId;

    //Insert a envio, tipo = sucursal
    $sql2 = "INSERT INTO envio (id, user_id, tipo, domicilio, estado) VALUES (0, '$id', '$tipo', '$lastId', 'Esperando pago')";
    mysqli_query($con, $sql2);

    $_SESSION["id-envio"]=mysqli_insert_id($con);
}
//Si es a domicilio
else {
    $id = $_SESSION["id"];
    $tipo = $_POST["tipo"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email= $_POST["email"];
    $telefono = $_POST["telefono"];
    $observaciones = $_POST["detalles"];
    $calle = $_POST["calle"];
    $colonia = $_POST["colonia"];
    $cp = $_POST["CP"];
    $ciudad = $_POST["ciudad"];
    $estado = $_POST["estado"];
    $numero_calle = $_POST["numero_calle"];
    $paqueteria = $_POST["paqueteria"];

    $con = conecta();
    
    //Insert a Domicilio, tipo = sucursal
    $sql = "INSERT INTO direccion  VALUES (0, $id, '$tipo', '$calle', '$colonia', $cp, '$ciudad', '$estado', '$nombre', '$apellidos', '$numero_calle', '$email', '$telefono', '$observaciones', '$paqueteria')";
    $res = mysqli_query($con, $sql);

    //Last ID
    $lastId = mysqli_insert_id($con);

    $_SESSION["id-domicilio"]=$lastId;

    //Insert a envio, tipo = sucursal
    $sql2 = "INSERT INTO envio (id, user_id, tipo, domicilio, estado, paqueteria) VALUES (0, '$id', '$tipo', '$lastId', 'Esperando pago', '$paqueteria')";
    mysqli_query($con, $sql2);

    $_SESSION["id-envio"]=mysqli_insert_id($con);
}

header("Location: carrito4.php");

?>