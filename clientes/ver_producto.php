<?php
require "../conecta.php";

session_start();

error_reporting(0);
if ($_SESSION["id"] > 0) {
    //echo $_SESSION["id"];
} else {
    header("Location: ../login.php");
}

$id = $_GET['id'];
$t = $_GET['t'];

$con = conecta();

$sql = "SELECT * FROM productos WHERE id = " . $id . " AND status = 1 AND eliminado = 0";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if ($num != 0) {

    $id             = mysqli_result($res, 0, "id");
    $nombre         = mysqli_result($res, 0, "nombre");
    $codigo      = mysqli_result($res, 0, "codigo");
    $descripcion         = mysqli_result($res, 0, "descripcion");
    $stock            = mysqli_result($res, 0, "stock");
    $costo              = mysqli_result($res, 0, "costo");
    $archivo            = mysqli_result($res, 0, "archivo_n");
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
    <title>Mostrando producto</title>
    <link rel="stylesheet" type="text/css" href="../css/toast.css">
    <style>
        .agregarButton {
            color: white;
            background: #06964f;
            border-radius: 5px;
            padding: 7px;
            display: inline-block;
            font-size: 15px;
            cursor: pointer;
            margin-left: 170px;
        }

        .agregarButton:hover {
            background: #013220;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        img {
            max-width: 200px;
            border-radius: 10px;
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
            border: 1px solid crimson;
            border-radius: 8px;
            display: inline-block;
            padding: 15px;
        }

        .label {
            font-weight: bold;
            font-size: 18px;
        }

        .dato {
            float: right;
            margin-left: 20px;
            font-size: 18px;
        }
    </style>
    <script src="../resource/jquery-3.3.1.js"></script>
    <script>
        function agregarAlCarrito(productoF) {
            $.ajax({
                type: "POST",
                url: "agregar-al-carrito.php",
                dataType: 'json',
                data: ({
                    "producto": productoF,
                    "cantidad": "1"
                }),

                complete: function() {
                    console.log("Finish POST");
                    toast("Producto agregado con exito");
                    document.getElementById('header').contentWindow.location.reload();
                },
                success: function() {
                    console.log("Success POST");
                }
            })
        }

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

        function toast(text) {
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
    <iframe id="header" src="header.php" height="100" width="101.2%" frameBorder="0" scrolling="no"></iframe>
    <a id="backButton" href="productos.php">Regresar</a>
    <a class="agregarButton" onclick="agregarAlCarrito(<?php echo $id ?>); return false;">Agregar al carrito</a><br><br>

    <div id="container">
        <div style="width: 100%;"><img style="margin:auto ;" src="../productos/archivos/<?php echo $archivo; ?>.jpg"></div><br><br>
        <a class="label f">Nombre </a><a class="dato"><?php echo $nombre; ?></a><br><br>
        <a class="label g">Codigo </a><a class="dato"><?php echo $codigo; ?></a><br><br>
        <div style="display:inline-block;"><a class="label f">Descripcion </a>
            <div style=" float:right; word-wrap: break-word; max-width: 250px;"><a class="dato"><?php echo $descripcion; ?></a></div>
        </div><br><br>
        <a class="label g">Stock </a><a class="dato"><?php echo $stock; ?></a><br><br>
        <a class="label f">Costo </a><a class="dato">$<?php echo $costo; ?></a><br><br>
    </div>

    <div id="snackbar" name="snackbar"></div>
    <?php if ($t == 1) {
        echo "<script>myFunction();</script>";
    }
    ?>

</body>

</html>