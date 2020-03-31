<?php
require "conecta.php";

session_start();

error_reporting(0);
if ($_SESSION["id"] > 0) {
    //echo $_SESSION["id"];
} else {
    header("Location: login.php");
}

$id = $_GET['id'];

$con = conecta();

$sql = "SELECT * FROM administradores WHERE id = " . $id . " AND status = 1 AND eliminado = 0";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if ($num != 0) {

    $id             = mysqli_result($res, 0, "id");
    $nombre         = mysqli_result($res, 0, "nombre");
    $apellidos      = mysqli_result($res, 0, "apellidos");
    $correo         = mysqli_result($res, 0, "correo");
    $rolNum            = mysqli_result($res, 0, "rol");
    $_SESSION["rolNum"] = $rolNum;
    $archivo            = mysqli_result($res, 0, "archivo_n");

    /* echo "$id --- $nombre $apellidos <br>"; */
    $rol = "";
    switch ($rolNum) {
        case "1":
            $rol = "Usuario";
            break;

        case "2":
            $rol = "Administrador";
            break;

        default:
            $rol = "Error";
            break;
    }
}

function selectedOption($option)
{
    if ($_SESSION["rolNum"] == 1 && $option == 1) {
        echo "selected=\"true\"";
    } else if ($_SESSION["rolNum"] == 2 && $option == 2) {
        echo "selected=\"true\"";
    }
}

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function verUsuario()
{
    $id = $_GET['id'];

    $con = conecta();

    $sql = "SELECT * FROM administradores WHERE id = " . $id . " AND status = 1 AND eliminado = 0";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    if ($num != 0) {

        $id             = mysqli_result($res, 0, "id");
        $nombre         = mysqli_result($res, 0, "nombre");
        $apellidos      = mysqli_result($res, 0, "apellidos");
        $correo         = mysqli_result($res, 0, "correo");
        $rolNum            = mysqli_result($res, 0, "rol");
        $archivo            = mysqli_result($res, 0, "archivo_n");

        /* echo "$id --- $nombre $apellidos <br>"; */
        $rol = "";
        switch ($rolNum) {
            case "1":
                $rol = "Usuario";
                break;

            case "2":
                $rol = "Administrador";
                break;

            default:
                $rol = "Error";
                break;
        }

        echo
            "
        " . $id . "<br>
        " . $nombre . " 
        " . $apellidos . "<br>
        " . $correo . "<br>
        " . $rol . "<br>
        <img src=\"archivos/" . $archivo . ".jpg\"><br>
        ";
    }
}
?>

        <html>

        <head>
            <title>Mostrando usuario</title>
            <link rel="stylesheet" type="text/css" href="css/toast.css">
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

            <script src="resource/jquery-3.3.1.js"></script>
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

                function fileCheck() {
                    selectedPic = true;
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

                function validarRol() {
                    var rol = $("#rol").prop('selectedIndex');
                    if (rol != 0) {
                        console.log("Rol OK");
                        return true;
                    }
                    console.log("Error en rol");
                    return false;
                }

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
                    console.log("No archivo");
                    return false;
                }

                function validacion() {
                    //IF hay un archivo seleccionado
                    if (validarArchivo()) {
                        if (changed==true) {
                            console.log(changed);
                            if (validarNombre() && validarCorreo() && validarRol()) {
                                console.log("YES");

                                var varRol = $("#rol").val(),
                                    varNombre = $("#nombre").val(),
                                    varCorreo = $("#correo").val(),
                                    varApellidos = $("#apellidos").val(),
                                    varId = <?php echo $id; ?>,
                                    varCheck = 1;

                                var myFormData = new FormData();
                                myFormData.append('archivo', document.getElementById("archivo").files[0] );
                                myFormData.append('rol', varRol);
                                myFormData.append('nombre', varNombre);
                                myFormData.append('correo', varCorreo);
                                myFormData.append('apellidos', varApellidos);
                                myFormData.append('id', varId);
                                myFormData.append('check', varCheck);


                                $.ajax({
                                    type: "POST",
                                    url: "modifica_administradores.php",
                                    dataType: "JSON",
                                    data: myFormData,
                                    processData: false,
                                    contentType: false,

                                    complete: function() {
                                        console.log("Finish POST");
                                        window.location = "ver.php?id=" + varId + "&t=1";
                                    },
                                    success: function() {
                                        console.log("Success POST");
                                        window.location = "ver.php?id=" + varId + "&t=1";
                                    }
                                })
                            } else {
                                $("#errorMessage").html("Existen campos erroneos... <br>Por favor corrija los datos para continuar.").show();
                                setTimeout("$('#errorMessage').html('').hide()", 3000);
                            }
                        }
                    }
                    //ELSE no hay archivo seleccinado
                    else {
                        console.log("almost");
                        if (changed==true) {
                            console.log(changed);
                            if (validarNombre() && validarCorreo() && validarRol()) {
                                console.log("YES");

                                var varRol = $("#rol").val(),
                                    varNombre = $("#nombre").val(),
                                    varCorreo = $("#correo").val(),
                                    varApellidos = $("#apellidos").val(),
                                    varId = <?php echo $id; ?>,
                                    varCheck = 0;

                                $.ajax({
                                    type: "POST",
                                    url: "modifica_administradores.php",
                                    dataType: "JSON",
                                    data: {
                                        'check': varCheck,
                                        'nombre': varNombre,
                                        'correo': varCorreo,
                                        'apellidos': varApellidos,
                                        'rol': varRol,
                                        'id': varId
                                    },

                                    complete: function() {
                                        console.log("Finish POST");
                                        window.location = "ver.php?id=" + varId + "&t=1";
                                    },
                                    success: function() {
                                        console.log("Success POST");
                                        window.location = "ver.php?id=" + varId + "&t=1";
                                    }
                                })
                            } else {
                                $("#errorMessage").html("Existen campos erroneos... <br>Por favor corrija los datos para continuar.").show();
                                setTimeout("$('#errorMessage').html('').hide()", 3000);
                            }
                        }
                    }
                }
            </script>
        </head>

        <body>
            <iframe id="header" src="header.php" height="100" width="101.2%" frameBorder="0" scrolling="no"></iframe>
            <a id="backButton" href="tabla-mostrar-usuarios.php">Regresar</a><br><br>

            <div id="container">
                <div style="width: 100%;"><img style="margin:auto ;" src="archivos/<?php echo $archivo; ?>.jpg"></div><br>
                <input type="file" id="archivo" onchange="changeCheck(); fileCheck();" name="archivo"><br><br>
                <a class="label">ID: </a><a id="id" name="id" value="<?php echo $id; ?>"><?php echo $id; ?></a><br><br>
                <a class="label">Nombre </a><input id="nombre" onchange="changeCheck();"  name="nombre" class="dato" value="<?php echo $nombre; ?>"><br><br>
                <a class="label">Apellidos </a><input id="apellidos" name="apellidos" onchange="changeCheck();" class="dato" value="<?php echo $apellidos; ?>"><br><br>
                <a class="label">Correo </a><input id="correo" name="correo" class="dato" onchange="changeCheck();" value="<?php echo $correo; ?>"><br><br>
                <a class="label">Puesto </a>
                <select style="float: right;" name="rol" id="rol" onchange="changeCheck();">
                    <option value="0">Elegir rol</option>
                    <option <?php selectedOption(1); ?> value="1">Usuario</option>
                    <option <?php selectedOption(2); ?> value="2">Administrador</option>
                </select><br><br>
                <input onclick="validacion(); return false;" class="btn btn-success" type="submit" value="Modificar Usuario" name="submit" id="submit"><br>
            </div>

            <div id="snackbar" name="snackbar">Usuario modificado con exito</div>

            <div id="errorContainer">
                <h2 hidden id="errorMessage" name="errorMessage"></h2>
            </div>

        </body>

        </html>