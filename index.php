<?php

require_once "clases/Conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql = "SELECT * from usuarios where email='admin'";
$result = mysqli_query($conexion, $sql);
$validar = 0;
if (mysqli_num_rows($result) > 0) {
	$validar = 1;
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login de usuario</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
</head>

<body class="text-center">

	<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">	
		<div class="card p-5">

		    <img src="img/ventas.jpg"  height="190">

			<h2 class="text-center">Inicio de Sesión</h2>
			<form id="frmLogin">				
				<input type="text" class="form-control input-sm" name="usuario" id="usuario">
				<label for="usuario">Usuario</label>				
				<input type="password" name="password" id="password" class="form-control input-sm">
				<label>Password</label>
				<p></p>
				<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
				<?php if (!$validar) : ?>
					<a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
				<?php endif; ?>
			</form>
		</div>
	</div>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#entrarSistema').click(function() {

			vacios = validarFormVacio('frmLogin');

			if (vacios > 0) {
				alert("Debes llenar todos los campos!!");
				return false;
			}

			datos = $('#frmLogin').serialize();
			$.ajax({
				type: "POST",
				data: datos,
				url: "procesos/regLogin/login.php",
				success: function(r) {

					if (r == 1) {
						window.location = "vistas/inicio.php";
					} else {
						alert("No se pudo acceder :(");
					}
				}
			});
		});
	});
</script>