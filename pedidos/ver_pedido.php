<?php
require "../conecta.php";

session_start();

error_reporting(0);
if ($_SESSION["id"] > 0) {
    //echo $_SESSION["id"];
} else {
    header("Location: ../login.php");
}

if($_SESSION["rol"] == 1 || $_SESSION["rol"] == 4) {
    header("Location: ../clientes/home.php");
}

$id = $_GET['id'];
$t = $_GET['t'];

$con = conecta();

$sql = "SELECT * FROM pedidos WHERE id='$id'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if ($num != 0) {

    $id             = mysqli_result($res, 0, "id");
    $fecha          = mysqli_result($res, 0, "fecha");
    $usuario          = mysqli_result($res, 0, "usuario");
    $status          = mysqli_result($res, 0, "status");
}


function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function mostrarProductos()
{
    $id = $_GET['id'];
    $con = conecta();

    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido='$id'";

    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    $total_pedido = 0;

    for ($i = 0; $i < $num; $i++) {

        $producto             = mysqli_result($res, $i, "id_producto");
        $cantidad             = mysqli_result($res, $i, "cantidad");

        $sql2 = "SELECT * FROM productos WHERE id='$producto'";

        $res2 = mysqli_query($con, $sql2);
        $num2 = mysqli_num_rows($res2);

        if ($num2 != 0) {

            $id_producto         = mysqli_result($res2, 0, "id");
            $nombre              = mysqli_result($res2, 0, "nombre");
            $codigo              = mysqli_result($res2, 0, "codigo");
            $descripcion         = mysqli_result($res2, 0, "descripcion");
            $costo               = mysqli_result($res2, 0, "costo");
            $archivo             = mysqli_result($res2, 0, "archivo_n");

            $total = $cantidad * $costo;
            $total_pedido = $total_pedido + $total;

            //MOSTRAR PRODUCTO
            echo "<tr id=\"" . $id_producto . "\" class=\"row\">
                    <td><a>" . $i . "</a></td>
                    <td><a>" . $cantidad . "</a></td>
                    <td><img src=\"../productos/archivos/" . $archivo . ".jpg\" class=\"profile-pic\" ></td>
                    <td><a>" . $id_producto . "</a></td>
                    <td style=\"word-wrap: break-word; max-width: 150px;\"><a>" . $nombre . "</a>
                    <td><a>" . $codigo . "</a></td>
                    <td style=\"word-wrap: break-word; max-width: 200px;\"  ><a>" . $descripcion . "</a></td>
                    <td><a>$" . $costo . "</a></td>
                    <td class=\"total\" ><a>$" . $total . "</a></td>
                </tr>";
        }
    }

    echo "<tr> 
            <td colspan=\"8\" ><a style=\"float:right; font-weight: bold; margin: 15px;\"> Total del pedido: </a></td>
            <td class=\"total\" ><a style=\"font-size: 20px; margin: 5px;\" >$".$total_pedido."</a></td>
          </tr>";
}

?>

<html>

<head>
    <title>Mostrando pedido</title>
    <link rel="stylesheet" type="text/css" href="../css/toast.css">
    <style>
        .profile-pic {
            width: 100%;
            max-width: 100px;
        }

        table {
            border: solid 3px gray;
            background: white;
            border-radius: 5px;
            text-align: center;
            margin: auto;
        }

        td {
            border-radius: 3px;
            padding-left: 10px;
            padding-right: 10px;
            border: solid 1px gray;
        }

        .row {
            height: 110px;
        }

        #backButton {
            text-decoration: none;
            border-radius: 8px;
            padding: 8px;
            background: darkgrey;
            color: white;
            font-size: 30 px;
            margin-top: 30px;
        }

        #backButton:hover {
            background: rgb(99, 99, 99);
            color: white;
        }

        #header {
            margin-left: -8px;
            margin-top: -8px;
            box-shadow: 5px 2px 10px #888888;
            margin-bottom: 17px;
        }

        #container {
            text-align: center;
        }

        .label {
            font-weight: bold;
            font-size: 17px;
        }

        #data {
            display: inline;
        }

        .description-box {
            display: inline;
            padding: 10px;
            background: lightgrey;
            border-radius: 3px;
        }

        .total {
            background: #ededed;
        }
    </style>
    <script>
        function myFunction() {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</head>

<body>
    <iframe id="header" src="../header.php" height="100" width="101.2%" frameBorder="0" scrolling="no"></iframe>
    <a id="backButton" href="tabla-mostrar-pedidos.php">Regresar</a><br><br>

    <div id="container">
        <div id="data">
            <!-- Pedidos -->
            <div class="description-box"><a class="label f">ID </a><a class="dato"><?php echo $id; ?></a></div>
            <div class="description-box"><a class="label f">Fecha </a><a class="dato"><?php echo $fecha; ?></a></div>
            <div class="description-box"><a class="label g">Usuario </a><a class="dato"><?php echo $usuario; ?></a></div>
            <div class="description-box"><a class="label f">Status </a><a class="dato"><?php echo $status; ?></a></div>

            <!-- Productos -->
            <div style="text-align: center; margin-top: 20px;">
                <table>
                    <tr>
                        <td><a>#</a></td>
                        <td><a>Cantidad</a></td>
                        <td><a>Imagen</a></td>
                        <td><a>ID</a></td>
                        <td><a>Nombre</a></td>
                        <td><a>Codigo</a></td>
                        <td><a>Descripcion</a></td>
                        <td><a>Costo</a></td>
                        <td class="total" ><a>Total</a></td>
                    </tr>

                    <?php mostrarProductos(); ?>

                </table>
            </div>
        </div>
    </div>

    <div id="snackbar" name="snackbar">Producto modificado con exito</div>
    <?php if ($t == 1) {
        echo "<script>myFunction();</script>";
    }
    ?>

</body>

</html>