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

$con = conecta();

$sql = "SELECT * FROM clientes WHERE id = " . $id . " AND status = 1 AND eliminado = 0";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if ($num != 0) {

    $id             = mysqli_result($res, 0, "id");
    $nombre         = mysqli_result($res, 0, "nombre");
    $apellidos      = mysqli_result($res, 0, "apellidos");
    $correo         = mysqli_result($res, 0, "correo");
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
    <title>Editar cliente</title>
    <link rel="stylesheet" type="text/css" href="../css/toast.css">
    <style>
        #errorContainer {
            display: inline-block;
        }

        #errorMessage {
            font-size: 20px;
            color: white;
            margin-left: 20px;
            border: solid 1px tomato;
            background: tomato;
            border-radius: 4px;
            padding: 5px;
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
    <script>
        var changed = false;
        var selectedPic = false;

        function changeCheck() {
            changed = true;
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
            console.log("Error en nombre");
            return false;
        }

        function validacion() {
            console.log("almost");
            if (changed == true) {
                console.log(changed);
                if (validarNombre() && validarCorreo()) {
                    console.log("YES");

                    var varNombre = $("#nombre").val(),
                        varApellidos = $("#apellidos").val(),
                        varCorreo = $("#correo").val(),
                        varId = <?php echo $id; ?>;

                    $.ajax({
                        type: "POST",
                        url: "modifica_cliente.php",
                        dataType: "JSON",
                        data: {
                            'nombre': varNombre,
                            'apellidos': varApellidos,
                            'correo': varCorreo,
                            'id': varId
                        },

                        complete: function() {
                            console.log("Finish POST");
                            window.location = "ver_cliente.php?id=" + varId + "&t=1";
                        },
                        success: function() {
                            console.log("Success POST");
                            window.location = "ver_cliente.php?id=" + varId + "&t=1";
                        }
                    })
                } else {
                    $("#errorMessage").html("Existen campos erroneos... <br>Por favor corrija los datos para continuar.").show();
                    setTimeout("$('#errorMessage').html('').hide()", 3000);
                }
            }

        }
    </script>
</head>

<body>
    <iframe id="header" src="../header.php" height="100" width="101.2%" frameBorder="0" scrolling="no"></iframe>
    <a id="backButton" href="tabla-mostrar-cliente.php">Regresar</a><br><br>

    <div id="container">
        <a class="label">ID: </a><a id="id" name="id" value="<?php echo $id; ?>"><?php echo $id; ?></a><br><br>
        <a class="label">Nombre </a><input id="nombre" onchange="changeCheck();" name="nombre" class="dato" value="<?php echo $nombre; ?>"><br><br>
        <a class="label">Apellidos </a><input id="apellidos" onchange="changeCheck();" name="apellidos" class="dato" value="<?php echo $apellidos; ?>"><br><br>
        <a class="label">Correo </a><input id="correo" onchange="changeCheck();" name="correo" class="dato" value="<?php echo $correo; ?>"><br><br>

        <input onclick="validacion(); return false;" class="btn btn-success" type="submit" value="Modificar Cliente" name="submit" id="submit"><br>
    </div>

    <div id="snackbar" name="snackbar">Cliente modificado con exito</div>

    <div id="errorContainer">
        <h2 hidden id="errorMessage" name="errorMessage"></h2>
    </div>

</body>

</html>