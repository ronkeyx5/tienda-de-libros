<?php
require "../conecta.php";

function mysqli_result($res, $row, $field=0)    {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function generarRows() {

    $con = conecta();

    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    for ($i = 0; $i < $num; $i++){
    $id             = mysqli_result($res, $i, "id");
    $nombre         = mysqli_result($res, $i, "nombre");
    $codigo      = mysqli_result($res, $i, "codigo");
    $descripcion         = mysqli_result($res, $i, "descripcion");
    $stock            = mysqli_result($res, $i, "stock");
    $costo              = mysqli_result($res, $i, "costo");
    $archivo            = mysqli_result($res, $i, "archivo_n");

    echo
    "<tr id=\"".$id."\" class=\"row\">
        <td><img src=\"archivos/".$archivo.".jpg\" class=\"profile-pic\" ></td>
        <td><a>".$id."</a></td>
        <td style=\"word-wrap: break-word; max-width: 150px;\"><a>".$nombre."</a>
        <td><a>".$codigo."</a></td>
        <td style=\"word-wrap: break-word; max-width: 200px;\"  ><a>".$descripcion."</a></td>
        <td><a>$".$costo."</a></td>
        <td><a>".$stock."</a></td>
        <td>
            <div>
                <a class=\"button eliminarButton\" id=\"".$id."\" onclick=\"eliminarRegistro(".$id."); return false;\" href=\"#Eliminar\" >Eliminar</a><br><br>
                <a class=\"button editarButton\" id=\"".$id."\" href=\"editar_producto.php?id=".$id."\">Editar</a><br>
                <a class=\"button verButton\" id=\"".$id."\" href=\"ver_producto.php?id=".$id."&t=0\" >Ver</a>
            </div>
        </td>
    </tr>";

    }
}
?>