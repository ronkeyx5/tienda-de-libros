<?php
session_start();

error_reporting(0);
if($_SESSION["id"] > 0) {
    //echo $_SESSION["id"];
    }
else {
    header("Location: login.php");
    }
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Formulario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="resource/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script>
        function validarExtension() {
            var file = $("#archivo").val();
            console.log(file);
            var extension = file.replace(/^.*\./, '');

            if (extension == 'jpg') {
                console.log("Extension OK");
                return true;
            }
            console.log("Error en extension");
            return false;
        }

        function validarArchivo() {
            if ($('#archivo').get(0).files.length != 0) {
                console.log("Archivo cargado OK");
                return validarExtension();
            }
            console.log("Error en Archivo todo");
            return false;
        }

        function validarPass() {
            var passF = $('#pass').val();
            if (passF.length > 7) {
                console.log("Pass OK");
                return true;
            }
            console.log("Error en pass");
            return false;
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function validarCorreo() {
            var email = $('#correo').val();
            if ($('#correo') != '' && isEmail(email)) {
                console.log("Correo OK");
                return true;
            }
            console.log("Error en correo");
            return false;
        }

        function validarNombre() {
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();

            if (nombre.length > 0 && apellidos.length > 0) {
                console.log("Nombre OK");
                return true;
            }
            console.log("Error en nombre y/o pass");
            return false;
        }

        function validarRol() {
            var rol = $("#rol").prop('selectedIndex');
            if (rol != 0) {
                console.log("Rol OK");
                return true;
            }
            console.log("Error en rol");
            return false;
        }

        function validacion() {
            var form = document.getElementById("myform");
            var fd = new FormData(form);

            console.log("F\n");

            if (validarNombre() && validarCorreo() && validarPass() && validarRol() && validarArchivo()) {

                $.ajaxSetup({
                    async: true
                });
                $.ajax({
                    type: "POST",
                    url: "salva_administradores.php",
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,

                    complete: function () {
                        console.log("Finish POST");
                    },
                    success: function () {
                        console.log("Success POST");
                        window.location = "tabla-mostrar-usuarios.php";
                    }
                })
            }
            else {
                //alert('Existen campos vacios... Por favor inserte datos para continuar.');
                $("#errorMessage").html("Existen campos vacios o erroneos... <br>Por favor inserte datos para continuar.");
                setTimeout("$('#errorMessage').html('')", 3000);
            }
        }
    </script>

    <style>
        #backButton {
            text-decoration: none;
            border-radius: 8px;
            text-align: end;
        }

        #backButton:hover   {
            background: rgb(99, 99, 99);
            color: white;
        }

        h1 {
            color: rgb(48, 48, 48);
            font-size: 30px;
            padding-left: 15px;
            padding-right: 15px;
            margin-top: 20px;
        }

        #errorContainer {
            display: inline-block;
        }

        #errorMessage {
            font-size: 20px;
            color: white;
            margin-left: 20px;
            border: solid 1px tomato;
            background: tomato;
        }

        input {
            margin-top: 15px;
            padding: 10px;
            margin-left: 10px;
        }

        select {
            margin-left: 10px;
            padding: 10px;
        }

        #regBox {
            border: solid 2px gray;
            border-radius: 8px;
            padding: 5px;
            padding-right: 10px;
            padding-bottom: 10px;
            display: inline-block;
            margin-top: 20px;
            background: white;
        }

        #registro {
            text-align: center;
            margin: auto;
        }

        #content {
            margin: auto;
        }

        a {
            padding: 8px;
            background: darkgrey;
            color: white;
            font-size: 30 px;
            margin-top: 30px;
            margin-left: 15px;
        }
        body {
            background: #f0f0f0;
        }
        #header {
        margin-left: -8px;
        margin-top: -8px;
        box-shadow: 5px 2px 10px #888888;
        margin-bottom: 17px;
    }
    </style>

</head>

<body>
    <iframe id="header" src="header.php" height="100" width="101.2%" frameBorder="0" scrolling="no" ></iframe>
    <br>
            <a id="backButton" href="tabla-mostrar-usuarios.php">Regresar</a>
    <div id="content" class="container-fluid">
        <div name="registro" id="registro">
            <form name="myform" id="myform" autocomplete="off" enctype="multipart/form-data" method="POST">
                <div id="regBox">
                    <h1>Registro de usuarios</h1>
                    <input placeholder="Nombre" type="text" name="nombre" id="nombre" required /><br>
                    <input placeholder="Apellidos" type="text" name="apellidos" id="apellidos" required /><br>
                    <input placeholder="Correo" autocomplete="off" type="text" name="correo" id="correo" required /><br>
                    <input placeholder="Contrasena (8 min)" autocomplete="off" type="password" name="pass" id="pass" required /><br><br>
                    <select name="rol" id="rol" required >
                        <option value="0">Elegir rol</option>
                        <option value="1">Usuario</option>
                        <option value="2">Administrador Completo</option>
                        <option value="3">Administrador de Informacion y Usuarios</option>
                        <option value="4">Administrador de Inventario</option>
                    </select><br><br>
                    <input type="file" id="archivo" name="archivo" required><br>

                    <div>
                        <input onclick="validacion(); return false;" class="btn btn-success" type="submit"
                            value="Crear usuario" name="submit" id="submit"><br>
                    </div>
                    
                </div><br>
                <div id="errorContainer">
                    <h2 id="errorMessage" name="errorMessage"></h2>
                </div>
            </form>
        </div>
    </div>
    
</body>

</html>