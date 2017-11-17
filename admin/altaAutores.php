<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['nombre'])){

		require_once("conexion.php");

		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];

		$consulta = "INSERT INTO autores(nombre, apellidos) VALUES ('$nombre', '$apellidos');";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("<div class='success-msg'>
					<i class='fa fa-check'></i>
					Se ha añadido correctamente
					</div>
			");
		}else{
			echo ("<div class='error-msg'>
					<i class='fa fa-times-circle'></i>
					No se pudo añadir
					</div>");
		}
	}

?>

<h2 class="medio">Añadir un nuevo autor</h2>

<form action="altaAutores.php" method="post">
	<div class="container">
		<label>Nombre</label>
		<input type="text" name="nombre" placeholder="Nombre del autor" required pattern="[a-zA-Z]{1,25}" title="Solo letras en el nombre">
		<label>Apellidos</label>
		<input type="text" name="apellidos" placeholder="Apellidos del autor" required pattern="[a-zA-Z\s]+" title="Solo letras en los apellidos">
		<input type="submit" value="Añadir">
	</div>
</form>

