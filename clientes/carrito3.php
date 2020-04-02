<?php

session_start();

?>

<html>

<head>
    <title>Carrito 3/4</title>
    <style>
        .total {
            background: #ededed;
            font-weight: bold;
        }

        .next {
            background: #21ad46;
            border: 1px solid #21ad46;
            text-decoration: none;
            border-radius: 8px;
            padding: 8px;
            color: white;
            font-size: 40 px;
            margin-top: -10px;
            cursor: pointer;
            float: right;
        }

        .next:hover {
            background: #187a32;
            border: 1px solid #187a32;
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

        #domicilio {
            width: 460px;
            height: 410px;
        }

        input {
            width: 250px;
            height: 25px;
            border-radius: 3px;
            border: 1px solid gray;
            padding: 3px;
        }

        #estado {
            width: 150px;
            height: 30px;
        }

        textarea {
            border-radius: 3px;
            border: 1px solid gray;
            resize: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/toast.css">

    <script src="../resource/jquery-3.3.1.js"></script>

    <script>
        function confirmarPedido() {
            if (confirm("¿Desea confirmar el pedido?")) {
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
    <div class="top">
        <h2 id="title">Carrito de compra 3/4</h2>
    </div><br>
    <div style="float:left; margin-top: 20px; padding: 15px; border: 1px solid gray;">

        <!-- FORMULARIO -->

        <select id="selectMetodo">
            <option value="branch">En sucursal</option>
            <option value="address">A domicilio</option>
        </select><br><br>

        <!-- Sucursal -->
        <div id="sucursal">
            <a>Puede retirar en cualquiera de nuestras sucursales</a><br>
            <iframe style="border: 1px solid gray; border-radius: 5px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.7306919271227!2d-103.35126798460101!3d20.680532704949492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b1919766580d%3A0xacbb80beec833cc5!2sMundo%20Vela!5e0!3m2!1sen!2smx!4v1585762360124!5m2!1sen!2smx" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <br><br>

            <form action="guardarDomicilio.php" method="POST">
                Nombre <input name="nombre" style="width: 309px;" required id="nombre"><br><br>
                Apellidos <input name ="apellidos" style="width: 300px;" required id="apellidos"><br><br>
                Email <input name="email" type="email" style="width: 190px;" required id="email">&nbsp;&nbsp;&nbsp;
                Telefono <input name="telefono" style="width: 132px;" required id="telefono"><br><br>
                Observaciones<br><textarea name="detalles" id="detalles" style="height: 65px; width: 400px;" placeholder="Detalles extra para la entrega de su pedido"></textarea>
                <br><br><br>

                <input name="tipo" id="tipo" value="sucursal" hidden>

                <a id="backButton" href="carrito2.php">Regresar</a>
                <input style="height: 34px; width: 83px;" class="next" type="submit" value="Siguiente">
            </form>


        </div>

        <!-- Domicilio -->
        <div id="domicilio" hidden>
            <form action="guardarDomicilio.php" method="POST">
                Nombre <input name="nombre" style="width: 309px;" required id="nombre"><br><br>
                Apellidos <input name="apellidos" style="width: 300px;" required id="apellidos"><br><br>
                Email <input name="email" type="email" style="width: 190px;" required id="email">&nbsp;&nbsp;&nbsp;
                Telefono <input name="telefono" style="width: 132px;" required id="telefono"><br><br>
                Calle <input name="calle" style="width: 250px;" required id="calle">&nbsp;&nbsp;&nbsp;
                Numero <input name="numero_calle" style="width: 80px;" required id="numero"><br><br>
                Colonia <input name="colonia" style="width: 260px;" required id="colonia">&nbsp;&nbsp;&nbsp;
                CP <input name="CP" style="width: 88px;" required type="number" id="cp"><br><br>
                Ciudad <input name="ciudad" id="ciudad"><br><br>

                Estado <select name="estado" id="estado">
                    <option value="0">Selecciona un estado</option>
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Coahuila">Coahuila</option>
                    <option value="Colima">Colima</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Durango">Durango</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco" selected="selected">Jalisco</option>
                    <option value="Estado de México">Estado de México</option>
                    <option value="Michoacán">Michoacán</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo León">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Querétaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosí">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>
                </select><br><br>

                Paqueteria <select name="paqueteria" style="width: 150px; height: 30px;" id="paqueteria">
                    <option value="DHL">DHL</option>
                    <option value="Fedex">Fedex</option>
                    <option value="UPS">UPS</option>
                    <option value="Correos de Mexico">Correos de Mexico</option>
                </select><br><br><br>

                Observaciones<br><textarea name="detalles" id="detalles" style="height: 65px; width: 400px;" placeholder="Detalles extra para la entrega de su pedido"></textarea>

                <input name="tipo" id="tipo" value="domicilio" hidden>

                <br><br>
                <a id="backButton" href="carrito2.php">Regresar</a>
                <input style="height: 34px; width: 83px;" class="next" type="submit" value="Siguiente">
            </form>
        </div>
    </div>
    <div id="snackbar" name="snackbar"></div>
</body>

<script>
    var metodo = document.getElementById("selectMetodo");

    metodo.addEventListener("change", function() {
        console.log("yes");

        if (metodo.value == "branch") {
            console.log("sucursal");
            document.getElementById("domicilio").style.display = "none";
            document.getElementById("sucursal").style.display = "block";
        } else if (metodo.value == "address") {
            console.log("direccion");
            document.getElementById("sucursal").style.display = "none";
            document.getElementById("domicilio").style.display = "block";
        }

    })
</script>

</html>