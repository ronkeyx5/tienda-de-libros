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
        $id_transaccion = mysqli_result($res, $i, "id_transaccion");

        echo
            "<tr id=\"" . $id . "\" clas    s=\"row\">
        <td><a>" . $id . "</a></td>
        <td><a>" . $fecha . "</a></td>";

        //SELECT clientes
        $sql2 = "SELECT * FROM clientes WHERE id='$usuario'";
        $res2 = mysqli_query($con, $sql2);

        $userName = mysqli_result($res2, 0, "nombre");

        //SELECT Envio
        $sqlenvio = "SELECT * FROM envio WHERE id_transaccion='$id_transaccion'";
        $resenvio = mysqli_query($con, $sqlenvio);

        $estado = mysqli_result($resenvio, 0, "estado");
        $fechaEntrega = mysqli_result($resenvio, 0, "fecha_entrega");
        $numeroRastreo = mysqli_result($resenvio, 0, "numero_rastreo");
        $paqueteria = mysqli_result($resenvio, 0, "paqueteria");
        $id_domicilio = mysqli_result($resenvio, 0, "domicilio");

        //SELECT domicilio
        $sqlDom = "SELECT * FROM direccion WHERE id='$id_domicilio'";
        $resDom = mysqli_query($con, $sqlDom);

        $tipo = mysqli_result($resDom, 0, "tipo");
        $domicilio = "";

        if ($tipo != "sucursal") {
            $calle = mysqli_result($resDom, 0, "calle");
            $numero_calle = mysqli_result($resDom, 0, "numero_calle");
            $CP = mysqli_result($resDom, 0, "CP");
            $ciudad = mysqli_result($resDom, 0, "ciudad");
            $estadoJ = mysqli_result($resDom, 0, "estado");
            $colonia = mysqli_result($resDom, 0, "colonia");

            $domicilio = $calle . " " . $numero_calle . "<br> " . $colonia . "<br>" . $CP . "<br>" . $ciudad . "<br>" . $estadoJ;
        } else {
            $domicilio = $tipo;
        }
            //SELECT transaccion
            $sqltrans = "SELECT * FROM transaccion WHERE id='$id_transaccion'";
            $restrans = mysqli_query($con, $sqltrans);

            $total = mysqli_result($restrans, 0, "cantidad");
            $metodo = mysqli_result($restrans, 0, "metodo");

            echo "
        <td><a>" . $id_transaccion . "</a></td>
        <td><a>" . $userName . "</a></td>
        <td><a>" . $estado . "</a></td>

        <td><a>" . $fechaEntrega . "</a></td>
        <td><a>" . $numeroRastreo . "</a></td>
        
        <td><a>" . $domicilio . "</a></td>

        <td><a>" . $metodo . "</a></td>
        <td><a>" . $paqueteria . "</a></td>
        <td><a>" . $total . "</a></td>

        <td>
            <div>
                <a class=\"button editarButton\" id=\"" . $id . "\" href=\"cambiar_status_pedido.php?id=" . $id_transaccion . "&status=" . $estado . "\">Cambiar status</a><br>
                <a class=\"button verButton\" id=\"" . $id . "\" href=\"ver_pedido.php?id=" . $id . "&t=0\" >Detalles</a>
                <a class=\"button eliminarButton\" id=\"" . $id . "\" onclick=\"eliminarRegistro(" . $id . "); return false;\" href=\"#Eliminar\" >X</a>
            </div>
        </td>
    </tr>";
        }
    }
