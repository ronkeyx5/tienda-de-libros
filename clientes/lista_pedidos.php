<?php
require "../conecta.php";

function mysqli_result($res, $row, $field=0)    {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function generarRows() {

    $con = conecta();
    $idu = $_SESSION['id'];

    $sql = "SELECT * FROM pedidos WHERE usuario='$idu'";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    for ($i = 0; $i < $num; $i++){
    $id             = mysqli_result($res, $i, "id");
    $fecha          = mysqli_result($res, $i, "fecha");
    $usuario          = mysqli_result($res, $i, "usuario");
    $status          = mysqli_result($res, $i, "status");

    echo
    "<tr id=\"".$id."\" class=\"row\">
        <td><a>".$id."</a></td>
        <td><a>".$fecha."</a></td>
        <td><a>".$status."</a></td>
        <td>
            <div>
                <a class=\"button verButton\" id=\"".$id."\" href=\"mostrar-pedidos.php?id=".$id."\" >Detalles</a>
            </div>
        </td>
    </tr>";

    }
}
?>