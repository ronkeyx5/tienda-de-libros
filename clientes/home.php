<?php
session_start();
require "../conecta.php";

error_reporting(0);
if ($_SESSION["id"] > 1) { } else {
    $_SESSION["id"]=1;
    $_SESSION["nombre"]="Invitado";
}

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function generarTarjetas()
{
    $con = conecta();

    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    for ($i = 0; $i < 5; $i++) {
        $id                  = mysqli_result($res, $i, "id");
        $nombre              = mysqli_result($res, $i, "nombre");
        $autor              = mysqli_result($res, $i, "Autor");
        $descripcion1         = mysqli_result($res, $i, "descripcion");
        $descripcion = substr($descripcion1, 0, 200) . "...";
        $costo               = mysqli_result($res, $i, "costo");
        $archivo             = mysqli_result($res, $i, "archivo_n");

        echo "
        <article id=" . $id . " class=\"card\">
            <div><a href=\"ver_producto.php?id=".$id."&t=0\" ><img class=\"picPrev\" src=\"../productos/archivos/" . $archivo . ".jpg\" ></a></div>
            <div><a class=\"costo\" >$" . $costo . "</a></div>  
            <div><a class=\"name\">" . $nombre . "</a></div>
            <div><a class=\"autor\">" . $autor . "</a></div><br>
            <div><a class=\"description\" >" . $descripcion . "</a></div><br><br>

            <a class=\"agregarButton\" onclick=\"agregarAlCarrito(" . $id . "); return false; \" >Agregar al carrito</a>
        </article>";
    }
}

?>

<html>

<head>
    <title>Inicio</title>
    <style>
        .slider {
            width: 850px;
            height: 370px;
            margin: auto;
            overflow: hidden;
            border-radius: 5px;
        }

        .slider ul {
            border-radius: 3px;
            display: flex;
            padding: 0;
            width: 850px;

            animation: cambio 20s infinite alternate linear;
        }

        .slider li {
            border-radius: 3px;
            width: 850px;
            list-style: none;
        }

        .slider img {
            border-radius: 5px;
            width: 850px;
        }

        @keyframes cambio {
            0% {
                margin-left: 0;
            }

            20% {
                margin-left: 0;
            }

            25% {
                margin-left: -100%;
            }

            45% {
                margin-left: -100%;
            }

            50% {
                margin-left: -200%;
            }

            70% {
                margin-left: -200%;
            }

            75% {
                margin-left: -300%;
            }

            100% {
                margin-left: -300%;
            }
        }



        article {
            position: relative;
        }

        .agregarButton {
            color: white;
            background: #06964f;
            border-radius: 2px;
            padding: 7px;
            display: inline-block;
            position: absolute;
            bottom: 0;
            left: 0;
            font-size: 12px;
            cursor: pointer;
        }

        .agregarButton:hover {
            background: #013220;
        }

        .picPrev {
            max-width: 200px;
            margin: auto;
        }

        .name {
            margin: auto;
            font-weight: bold;
            font-size: 20px;
        }

        .autor {
            margin: auto;
            font-weight: bold;
            font-size: 17px;
            color: #013220;
        }

        .description {
            font-size: 14px;
        }

        .costo {
            font-weight: bold;
            color: #ff5331;
        }

        body {
            background: #eaeaea;
            font-family: Arial, Helvetica, sans-serif;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            flex: 0 1 17%;
            background: white;
            border: white solid 1px;
            border-radius: 3px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .card:hover {
            box-shadow: 1px 1px 10px #b7b7b7;
        }

        #backButton {
            text-decoration: none;
            border-radius: 8px;
            text-align: end;
            border-radius: 5px;
            color: white;
            font-size: 15px;
            background: darkgrey;
            padding: 8px;
            display: inline-block;
        }


        #backButton:hover {
            background: #696969;
        }

        #cerrarButton {
            text-decoration: none;
            border-radius: 8px;
            text-align: end;
            border-radius: 5px;
            color: white;
            font-size: 15px;
            background: crimson;
            padding: 8px;
            display: inline-block;
        }

        #cerrarButton:hover {
            background: #800000;
        }

        #header {
            margin-left: -8px;
            margin-top: -8px;
            margin-bottom: 17px;
        }

        #card-container {
            display: inline-flexbox;
            flex-direction: end;
        }

        #backSlider {
            margin: -15px;
            margin-top: -20px;
            padding-bottom: 50px;
        }

        #destacados {
            text-align: center;
            font-weight: bold;
            margin-bottom: -5px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/toast.css">

    <script src="../resource/jquery-3.3.1.js"></script>
    <script>
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
                    myFunction("Producto agregado con exito");
                    document.getElementById('header').contentWindow.location.reload();
                },
                success: function() {
                    console.log("Success POST");
                }
            })
        }
    </script>
</head>

<body>
    <iframe id="header" src="header.php" height="115" width="101.2%" frameBorder="0" scrolling="no"></iframe>

    <div id="backSlider">
        <h2 id="destacados">Destacados</h2>
        <div class="slider">
            <ul>
                <li>
                    <a href="ver_producto.php?id=29&t=0"><img src="../productos/slider/Inkedanillos_LI.jpg" alt="">
                </li>
                <li>
                    <a href="ver_producto.php?id=36&t=0"><img src="../productos/slider/Inkedpoe_LI.jpg" alt="">
                </li>
                <li>
                    <a href="ver_producto.php?id=23&t=0"> <img src="../productos/slider/Inkeddivina_LI.jpg" alt="">
                </li>
                <li>
                    <a href="ver_producto.php?id=28&t=0"> <img src="../productos/slider/Inkedprejuicio_LI.jpg" alt="">
                </li>
            </ul>
        </div>
    </div>

    <div class="centered">

        <section class="cards">
            <?php generarTarjetas(); ?>

        </section>
    </div>

    <div><a style="margin-left: 18px" id="backButton" href="productos.php" >Ver todos los productos</a></div>

    <div id="snackbar" name="snackbar"></div>


</body>

<?php
if(isset($_GET["pedido"])) {
    if($_GET["pedido"]==1) {
        echo "<script>myFunction(\"¡El pedido se ha generado exitosamente!\");</script>";
    }
    else if ($_GET["pedido"]==2) {
        echo "<script>myFunction(\"El pedido ha sido cancelado y su informacion eliminada exitosamente\");</script>";
    }
}
?>
</html>