<?php
require "../conecta.php";

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function generarRows()
{

    $con = conecta();

    $sql = "SELECT * FROM pedidos";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    for ($i = 0; $i < $num; $i++) {
        $id             = mysqli_result($res, $i, "id");
        $fecha          = mysqli_result($res, $i, "fecha");
        $usuario          = mysqli_result($res, $i, "usuario");
        $status          = mysqli_result($res, $i, "status");

        echo
            "<tr id=\"" . $id . "\" clas    s=\"row\">
        <td><a>" . $id . "</a></td>
        <td><a>" . $fecha . "</a></td>";

        $sql2 = "SELECT * FROM clientes WHERE id='$usuario'";
        $res2 = mysqli_query($con, $sql2);

        $userName = mysqli_result($res2, 0, "nombre");

        echo "<td><a>" . $usuario . "</a></td>
        <td><a>" . $userName . "</a></td>
        <td><a>" . $status . "</a></td>
        <td>
            <div>
                <a class=\"button editarButton\" id=\"" . $id . "\" href=\"cambiar_status_pedido.php?id=" . $id . "&status=" . $status . "\">Cambiar status</a><br>
                <a class=\"button verButton\" id=\"" . $id . "\" href=\"ver_pedido.php?id=" . $id . "&t=0\" >Detalles</a>
                <!-- <a class=\"button eliminarButton\" id=\"" . $id . "\" onclick=\"eliminarRegistro(" . $id . "); return false;\" href=\"#Eliminar\" >X</a> -->
            </div>
        </td>
    </tr>";
    }
}
