<?php
session_start();
require "lista_administradores.php";

error_reporting(0);
if ($_SESSION["id"] > 0) {
    //echo $_SESSION["id"];
} else {
    header("Location: login.php");
}
if($_SESSION["rol"] != 2) {
    header("Location: clientes/home.php");
}
?>

<html>

<head>
    <title>Mostrar Usuarios</title>
    <style>
        #header {
            margin-left: -8px;
            margin-top: -8px;
            box-shadow: 5px 2px 10px #888888;
            margin-bottom: 17px;
        }

        body {
            background: #f0f0f0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .backButton {
            text-decoration: none;
            border-radius: 8px;
            text-align: end;
            padding: 8px;
            background: darkgrey;
            color: white;
            font-size: 30 px;
            margin-inline-start: 10px;
        }

        .backButton:hover {
            background: rgb(99, 99, 99);
            color: white;
        }

        #alta {
            float: right;
            margin-right: 10px;
            margin-top: -8px;
            background: #4CAF50;
        }

        #alta:hover {
            background: rgb(49, 114, 51);
        }

        .profile-pic {
            width: 100%;
            max-width: 100px;
        }

        table {
            border: solid 3px gray;
            background: white;
            border-radius: 5px;
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

        #alta-back {
            width: 100%;
            margin-right: 50px;
        }

        table {
            margin: auto;
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

        .editarButton {
            margin-bottom: 3px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/toast.css">

    <script src="resource/jquery-3.3.1.js"></script>
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
        function eliminarRegistro(deleteId) {
            if (confirm("Desea eliminar al usuario con ID: " + deleteId)) {
                console.log(deleteId);
                $.ajax({
                    type: "post",
                    url: "eliminar_usuario.php",
                    data: {
                        id: deleteId
                    },

                    success: function() {
                        $('#' + deleteId).hide();
                        myFunction("Usuario con ID: "+deleteId+" eliminado con exito");
                        //alert("Usuario con ID: " + deleteId + " Eliminado correctamente.");
                    }
                })
            }
            else {
                myFunction("Eliminacion de usuario cancelada");
            }
        }
    </script>

</head>

<body>
    <!-- Barra de navegacion -->
    <iframe id="header" src="header.php" height="100" width="101.2%" frameBorder="0" scrolling="no"></iframe>

    <br>
    <div id="alta-back">
        <a class="backButton" href="home.php">Regresar</a> <!-- Menu Principal -->
        <a class="backButton" href="Formulario.php" id="alta">Registrar nuevo usuario</a> <!-- Agregar Administradores-->
    </div>
    <br>

    <div id="tabla-admins">

        <!-- archivo | id | nombre | apellidos | correo | rol  || eliminar -->
        <!--  editar   -->
        <!--  ver      -->
        <table>
            <tr>
                <td colspan="7" style="text-align: center;"><br> Administradores <br><br></td>
            </tr>

            <!-- Nombres de columnas -->
            <tr>
                <td><a>Profile pic</a></td>
                <td><a>ID</a></td>
                <td><a>Nombre</a></td>
                <td><a>Correo</a></td>
                <td><a>Rol</a></td>
                <td>

                </td>
            </tr>

            <?php generarRows(); ?>
            <div id="snackbar" name="snackbar"></div>
            <!-- Rows generados por PHP || Administradores -->

        </table>
    </div>
</body>

</html>