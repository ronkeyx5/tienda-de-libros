<?php
session_start();
error_reporting(0);
?>

<!doctype html>
<html lang="en">

<head>
	<title>Login</title>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel=" stylesheet" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/toast.css">
	<script src="resource/jquery-3.3.1.js"></script>

	<script>
		function login() {
			var form = document.getElementById("myform");
			var fd = new FormData(form);
			var session;

			console.log("HERE");
			$.ajax({
				type: "POST",
				url: "validar_login.php",
				data: fd,
				cache: false,
				processData: false,
				contentType: false,

				success: function() {
					console.log("FFF");
					location.reload();
				}
			})
		}
	</script>

	<style>
		#errorMessage {
			background: crimson;
			font-size: 17px;
			color: white;
			border-radius: 4px;
		}
	</style>
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
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="loginBox">
						<img src="images/login.png" class="img-responsive" style="max-width: 100px;" alt="PHP MySQL logos">
						<h2>Inicio de Sesion</h2>

						<form id="myform" method="post">
							<div class="form-group">
								<input type="email" class="form-control input-lg" name="email" placeholder="Correo" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control input-lg" name="password" placeholder="Contraseña" required>
							</div>
							<button onclick="login(); return false;" type="submit" class="btn btn-success btn-block">Login</button>
						</form>

					</div><!-- /.loginBox -->
					<a id="brError" name="brError"></a>
					<a id="errorMessage" name="errorMessage"></a>

					<div id="snackbar" name="snackbar">Error de inicio de sesion</div>
					<?php
					if ($_SESSION["id"] > 0 && $_SESSION['type']==1) {
						header("Location: home.php");
					} else if ($_SESSION["id"] > 0 && $_SESSION['type']==2)	{
						header("Location: clientes/home.php");
					} else if ($_SESSION["id"] == -1) { 
						echo "<script>console.log('FFF'); myFunction();</script>";
						$_SESSION["id"] = -2;
					}
					?>
					<br><br><a href="clientes/formulario_cliente_no_login.php">Registrar usuario</a>
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div>
		<!--/.row-->
	</div><!-- /.container -->
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
	<div id="snackbar" name="snackbar"></div>
	<?php
	if($_SESSION['created']==1)	{
		echo "<script>myFunction(\"Usuario creado con exito... Inicie sesion\");</script>";
	}
	?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>