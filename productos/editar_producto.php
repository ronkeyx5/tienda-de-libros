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
?>

<html>

<head>
    <title>Editar producto</title>
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

        function fileCheck() {
            selectedPic = true;
        }

        function validarCostoStock() {
            var costo = $('#costo').val();
            var stock = $('#stock').val();

            if (stock.length > 0 && costo.length > 0) {
                console.log("Costo-Stock OK");
                return true;
            }
            console.log("Error Costo-Stock");
            return false;
        }

        function validarDescripcion() {
            var descripcion = $('#descripcion').val();
            if (descripcion.length > 0) {
                console.log("descripcion OK");
                return true;
            }
            console.log("Error en descripcion");
            return false;
        }

        function validarCodigo() {
            var codigo = $('#codigo').val();
            if (codigo.length > 0) {
                console.log("Correo OK");
                return true;
            }
            console.log("Error en correo");
            return false;
        }

        function validarNombre() {
            var nombre = $('#nombre').val();

            if (nombre.length > 0) {
                console.log("Nombre OK");
                return true;
            }
            console.log("Error en nombre");
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
                if (changed == true) {
                    console.log(changed);
                    if (validarNombre() && validarCodigo() && validarDescripcion() && validarCostoStock()) {
                        console.log("YES");

                        var varNombre = $("#nombre").val(),
                            varCodigo = $("#codigo").val(),
                            varDescripcion = $("#descripcion").val(),
                            varStock = $("#stock").val(),
                            varCosto = $("#costo").val(),
                            varId = <?php echo $id; ?>,
                            varCheck = 1;

                        var myFormData = new FormData();
                        myFormData.append('archivo', document.getElementById("archivo").files[0]);
                        myFormData.append('costo', varCosto);
                        myFormData.append('nombre', varNombre);
                        myFormData.append('codigo', varCodigo);
                        myFormData.append('descripcion', varDescripcion);
                        myFormData.append('stock', varStock);
                        myFormData.append('id', varId);
                        myFormData.append('check', varCheck);


                        $.ajax({
                            type: "POST",
                            url: "modifica_productos.php",
                            dataType: "JSON",
                            data: myFormData,
                            processData: false,
                            contentType: false,

                            complete: function() {
                                console.log("Finish POST");
                                window.location = "ver_productos.php?id=" + varId + "&t=1";
                            },
                            success: function() {
                                console.log("Success POST");
                                window.location = "ver_productos.php?id=" + varId + "&t=1";
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
                if (changed == true) {
                    console.log(changed);
                    if (validarNombre() && validarCodigo() && validarDescripcion() && validarCostoStock()) {
                        console.log("YES");

                        var varNombre = $("#nombre").val(),
                            varCodigo = $("#codigo").val(),
                            varDescripcion = $("#descripcion").val(),
                            varStock = $("#stock").val(),
                            varCosto = $("#costo").val(),
                            varId = <?php echo $id; ?>,
                            varCheck = 0;

                        $.ajax({
                            type: "POST",
                            url: "modifica_productos.php",
                            dataType: "JSON",
                            data: {
                                'check': varCheck,
                                'nombre': varNombre,
                                'codigo': varCodigo,
                                'descripcion': varDescripcion,
                                'costo': varCosto,
                                'stock': varStock,
                                'id': varId
                            },

                            complete: function() {
                                console.log("Finish POST");
                                window.location = "ver_producto.php?id=" + varId + "&t=1";
                            },
                            success: function() {
                                console.log("Success POST");
                                window.location = "ver_producto.php?id=" + varId + "&t=1";
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
    <iframe id="header" src="../header.php" height="100" width="101.2%" frameBorder="0" scrolling="no"></iframe>
    <a id="backButton" href="tabla-mostrar-productos.php">Regresar</a><br><br>

    <div id="container">
        <div style="width: 100%;"><img style="margin:auto ;" src="archivos/<?php echo $archivo; ?>.jpg"></div><br>
        <input type="file" id="archivo" onchange="changeCheck(); fileCheck();" name="archivo"><br><br>
        <a class="label">ID: </a><a id="id" name="id" value="<?php echo $id; ?>"><?php echo $id; ?></a><br><br>
        <a class="label">Nombre </a><input id="nombre" onchange="changeCheck();" name="nombre" class="dato" value="<?php echo $nombre; ?>"><br><br>
        <a class="label">Codigo </a><input id="codigo" name="codigo" onchange="changeCheck();" class="dato" value="<?php echo $codigo; ?>"><br><br>
        <a class="label">Descripcion </a><input id="descripcion" name="descripcion" class="dato" onchange="changeCheck();" value="<?php echo $descripcion; ?>"><br><br>
        <a class="label">Stock </a><input id="stock" type="number" onchange="changeCheck();" name="stock" class="dato" value="<?php echo $stock; ?>"><br><br>
        <a class="label">Costo $</a><input id="costo" type="number" onchange="changeCheck();" name="costo" class="dato" value="<?php echo $costo; ?>"><br><br>

        <input onclick="validacion(); return false;" class="btn btn-success" type="submit" value="Modificar Producto" name="submit" id="submit"><br>
    </div>

    <div id="snackbar" name="snackbar">Producto modificado con exito</div>

    <div id="errorContainer">
        <h2 hidden id="errorMessage" name="errorMessage"></h2>
    </div>

</body>

</html>