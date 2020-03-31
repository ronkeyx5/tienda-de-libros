<?php
session_start();
require "../conecta.php";

//error_reporting(0);
if ($_SESSION["id"] > 0) { } else {
    header("Location: ../login.php");
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
        $descripcion         = mysqli_result($res, $i, "descripcion");
        $costo               = mysqli_result($res, $i, "costo");
        $archivo             = mysqli_result($res, $i, "archivo_n");

        echo "
        <article id=" . $id . " class=\"card\">
            <div><img class=\"picPrev\" src=\"../productos/archivos/" . $archivo . ".jpg\" ></div>
            <div><a class=\"costo\" >$" . $costo . "</a></div>  
            <div><a class=\"name\">" . $nombre . "</a></div>
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
                    <a href="ver_producto.php?id=16&t=0"><img src="../productos/slider/6de5b8affd34cbde0591078157dc4d43.jpg" alt=""></a>
                </li>
                <li>
                    <a href="ver_producto.php?id=2&t=0"><img src="../productos/slider/58f8f99fdd8bc06963503ef8869b6111.jpg" alt="">
                </li>
                <li>
                    <a href="ver_producto.php?id=1&t=0"> <img src="../productos/slider/9035e3684868129e242d8d385717fb58.jpg" alt="">
                </li>
                <li>
                    <a href="ver_producto.php?id=17&t=0"> <img src="../productos/slider/a9e83cb755ee4e72101ac5d5dc7f31b7.jpg" alt="">
                </li>
                <li>
                    <a href="ver_producto.php?id=16&t=0"> <img src="../productos/slider/5916248bf4ae989b7c741562eb6403e8.jpg" alt="">
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

</html>