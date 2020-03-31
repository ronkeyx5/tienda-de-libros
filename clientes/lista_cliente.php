<?php
require "../conecta.php";

function mysqli_result($res, $row, $field=0)    {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function generarRows() {

    $con = conecta();

    $sql = "SELECT * FROM clientes WHERE status = 1 AND eliminado = 0";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    for ($i = 0; $i < $num; $i++){
    $id                  = mysqli_result($res, $i, "id");
    $nombre              = mysqli_result($res, $i, "nombre");
    $apellidos           = mysqli_result($res, $i, "apellidos");
    $correo              = mysqli_result($res, $i, "correo");
    

    echo
    "<tr id=\"".$id."\" class=\"row\">
        <td><a>".$id."</a></td>
        <td style=\"word-wrap: break-word; max-width: 150px;\"><a>".$nombre." ".$apellidos."</a>
        <td><a>".$correo."</a></td>
        <td>
            <div>
                <a class=\"button eliminarButton\" id=\"".$id."\" onclick=\"eliminarRegistro(".$id."); return false;\" href=\"#Eliminar\" >Eliminar</a><br><br>
                <a class=\"button editarButton\" id=\"".$id."\" href=\"editar_cliente.php?id=".$id."\">Editar</a><br>
                <a class=\"button verButton\" id=\"".$id."\" href=\"ver_cliente.php?id=".$id."&t=0\" >Ver</a>
            </div>
        </td>
    </tr>";

    }
}
?>