<?php
session_start();
require "../conecta.php";
//error_reporting(0);

function mostrarProductos()
{
    $con = conecta();
    $id = $_SESSION['id'];

    $sql = "SELECT * FROM carrito WHERE id_cliente='$id'";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    $_SESSION['carrito'] = $num;

    if ($num > 0) {
        $total_pedido = 0;
        for ($i = 0; $i < $num; $i++) {
            $productoid    = mysqli_result($res, $i, "id_producto");
            $cantidad      = mysqli_result($res, $i, "cantidad");

            $sql2 = "SELECT * FROM productos WHERE id='$productoid'";
            $con2 = conecta();
            $res2 = mysqli_query($con2, $sql2);


            $nombre              = mysqli_result($res2, 0, "nombre");
            $codigo              = mysqli_result($res2, 0, "codigo");
            $descripcion         = mysqli_result($res2, 0, "descripcion");
            $costo               = mysqli_result($res2, 0, "costo");
            $archivo             = mysqli_result($res2, 0, "archivo_n");

            $total = $cantidad * $costo;
            $total_pedido = $total_pedido + $total;

            echo "<tr id=\"" . $productoid . "\" class=\"row\">
                    <td><a>" . $i . "</a></td>
                    <td><a>".$cantidad."</a></td>
                    <td><img src=\"../productos/archivos/" . $archivo . ".jpg\" class=\"profile-pic\" ></td>
                    <td><a>" . $productoid . "</a></td>
                    <td style=\"word-wrap: break-word; max-width: 150px;\"><a>" . $nombre . "</a>
                    <td><a>" . $codigo . "</a></td>
                    <td style=\"word-wrap: break-word; max-width: 200px;\"  ><a>" . $descripcion . "</a></td>
                    <td><a>$" . $costo . "</a></td>
                    <td class=\"total\" ><a>$" . $total . "</a></td>
                </tr>";
        }
        echo "<tr> 
            <td colspan=\"8\" ><a style=\"float:right; font-weight: bold; margin: 15px;\"> Total del pedido: </a></td>
            <td class=\"total\" ><a style=\"font-size: 20px; margin: 5px;\" >$" . $total_pedido . "</a></td>
          </tr>";
    } else {
        echo "Sin productos dentro del carrito. <br><br>";
    }
}

function siguienteButton()  {
    if($_SESSION['carrito']>0) {
        echo "<a class=\"next\" onclick=\"confirmarPedido(); return false;\" >Confirmar Pedido</a>";
    }
}

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

?>

<html>

<head>
    <title>Carrito 2/2</title>
    <style>
        .total {
            background: #ededed;
            font-weight: bold;
        }
        .next {
            background: #21ad46;
            text-decoration: none;
            border-radius: 8px;
            padding: 8px;
            color: white;
            font-size: 30 px;
            margin-top: -10px;
            cursor: pointer;
            float: right;
        }

        .next:hover {
            background: #187a32;
            color: white;
        }

        body {
            background: #eaeaea;
            font-family: Arial, Helvetica, sans-serif;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            border-radius: 6px;
            padding: 2px;
            padding-left: 6px;
            padding-right: 6px;
            background: darkgrey;
            color: white;
            cursor: pointer;
        }

        .button:hover {
            background: rgb(99, 99, 99);
            color: white;
        }

        .eliminarButton {
            background: #e00909;
        }

        .eliminarButton:hover {
            background: #910707;
        }

        input {
            width: 40px;
        }

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

        #title {
            text-align: center;
            margin-top: 15px;
        }

        .top {
            background: #b7b7b7;
            margin: -8px;
            padding: 10px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/toast.css">

    <script src="../resource/jquery-3.3.1.js"></script>

    <script>
        function confirmarPedido() {
            if(confirm("¿Desea confirmar el pedido?")) {
                window.location = "crear-pedido.php";
            }
        }

        function myFunction(text) {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");

            // Add the "show" class to DIV
            x.className = "show";
            $('#snackbar').html(text);

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</head>

<body>
    <div class="top" >
        <h2 id="title" >Carrito de compra 2/2</h2>
    </div><br>
    <div style=" float:left; margin-top: 20px;">
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
                <td class="total"><a >Total</a></td>
            </tr>

            <?php mostrarProductos(); ?>

        </table>
        <br><br>
        <a id="backButton" href="carrito1.php">Regresar</a>
        <?php siguienteButton(); ?>
    </div>
    <div id="snackbar" name="snackbar"></div>
</body>

</html>