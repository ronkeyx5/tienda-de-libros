<?php
session_start();

error_reporting(0);
$id12 = $_SESSION["id"];
$rol12 = $_SESSION["rol"];

if ($id12 > 1) {
} else {
    header("Location: clientes/home.php");
}

if ($rol12 < 2) {
    header("Location: clientes/home.php");
}
?>

<html>

<head>
    <style>
        body {
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
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
            float: right;
        }

        #cerrarButton:hover {
            background: #800000;
        }

        #container {
            background: lightgray;
            width: 100%;
            padding: 15px;
        }

        #topDiv {
            margin-bottom: 15px;
            width: 97%;
        }

        #navigationDiv {
            width: 97%;
        }

        #name {
            font-size: 22px;
            float: right;
        }

        #profilePic {
            display: inline-block;
            max-width: 60px;
            float: right;
            border-radius: 5px;
            margin-left: 13px;
        }
    </style>
</head>

<body>
    <div id="container" name="container">
        <div id="topDiv">
            <a style="font-weight: bold; font-size: 25px">Minzon Admin</a>
            <!-- MOSTRAR PROFILE PIC EN LA BARRA -->
            <img id="profilePic" src="archivos/<?php echo $_SESSION["pic"]; ?>.jpg">
            <a id="name"><?php echo $_SESSION["nombre"]; ?></a>
        </div>
        <!-- INICIO || USUARIOS || PRODUCTOS || SALIR -->
        <div id="navigationDiv">
            <a id="backButton" href="home.php" target="_PARENT">INICIO</a>
            <?php
                if($rol12 == 2){
                echo '<a id="backButton" href="tabla-mostrar-usuarios.php" target="_PARENT">USUARIOS</a>';
                }
            ?>
            <?php
            if ($rol12 == 2 || $rol12 == 4) {
                echo '<a id="backButton" href="productos/tabla-mostrar-productos.php" target="_PARENT" >PRODUCTOS</a>';
            }
            ?>
            <?php
            if ($rol12 == 2 || $rol12 == 3) {
                echo '<a id="backButton" href="clientes/tabla-mostrar-cliente.php" target="_PARENT" >CLIENTES</a>';
            }
            ?>
            <?php
            if ($rol12 == 2 || $rol12 == 3) {
                echo '<a id="backButton" href="pedidos/tabla-mostrar-pedidos.php" target="_PARENT">PEDIDOS</a>';
            }
            ?>
            <a id="cerrarButton" href="closeSession.php" target="_PARENT">SALIR</a>
        </div>
    </div>
</body>

</html>