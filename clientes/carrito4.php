<?php

session_start();

?>

<html>

<head>
    <title>Carrito 4/4</title>
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
            margin: auto;
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
            font-size: 15px;
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
        <h2 id="title">Carrito de compra 4/4</h2>
    </div><br>
    <div style="float:left; margin-top: 20px; padding: 15px; border: 1px solid gray;">

        <!-- FORMULARIO -->

        <select id="selectMetodo">
            <option value="tarjeta">Pago con tarjeta</option>
            <option value="tienda">Efectivo en tienda</option>
        </select><br>

        <h2>Total del <br>Pedido: $<?php echo $_SESSION["total-pedido"]; ?></h2>

        <!-- Pago con tarjeta -->
        <div id="tarjeta">
            <form action="crear-pedido.php" method="POST">
                Nombre del titular<br>
                <input required name="nombre"><br><br>

                Tipo de tarjeta<br>
                <select required>
                    <option value="debito">Debito</option>
                    <option value="credito">Credito</option>
                </select><br><br>
                Numero de tarjeta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CVV<br>
                <input required style="width: 150px" name="tarjeta" placeholder="1234-5678-9012-3456">&nbsp;&nbsp;&nbsp;
                <input required style="width: 40px" name="cvv" placeholder="123"><br><br>
                Fecha de Expiracion<br>
                <input required style="width: 60px" name="expiracion" placeholder="mm-yy"><br><br><br>

                <input name="metodo" value="tarjeta" hidden >

                <a class="button eliminarButton"  style="float:left; padding:8px;" href="cancelarPedido.php?id-domicilio=<?php echo $_SESSION["id-domicilio"];?>&id-envio=<?php echo $_SESSION["id-envio"];?>">Cancelar</a>
                <input style="height: 34px; width: 120px;" class="next" type="submit" value="Completar Pedido">
            </form>
        </div>

        <!-- Efectivo en tienda -->
        <div id="tienda" hidden>
            <form action="crear-pedido.php" method="POST">
            <h3>Para realizar el pago en tiendad deberá <br>presentarse con su numero de folio<br>que se generará una vez que confirme el pedido.<br><br></h3>
            
            <input name="metodo" value="efectivo" hidden >

            <a class="button eliminarButton"  style="float:left; padding:8px;" href="cancelarPedido.php?id-domicilio=<?php echo $_SESSION["id-domicilio"];?>&id-envio=<?php echo $_SESSION["id-envio"];?>">Cancelar</a>
            <input style="height: 34px; width: 150px;" class="next" type="submit" value="Completar Pedido">
            </form>
        </div>

    </div>
    <div id="snackbar" name="snackbar"></div>
</body>

<script>
    var metodo = document.getElementById("selectMetodo");

    metodo.addEventListener("change", function() {
        console.log("yes");

        if (metodo.value == "tarjeta") {
            console.log("tarjeta");
            document.getElementById("tienda").style.display = "none";
            document.getElementById("tarjeta").style.display = "block";
        } else if (metodo.value == "tienda") {
            console.log("direccion");
            document.getElementById("tarjeta").style.display = "none";
            document.getElementById("tienda").style.display = "block";
        }

    })
</script>

</html>