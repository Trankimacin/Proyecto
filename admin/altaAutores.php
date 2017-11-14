<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['nombre'])){

		require_once("conexion.php");

		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];

		$consulta = "INSERT INTO autores(nombre, apellidos) VALUES ('$nombre', '$apellidos');";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("<h2>Autor añadido correctamente</h2>");
		}else{
			echo ("<h2>El autor no se pudo añadir</h2>");
		}
	}

?>


<form action="altaAutores.php" method="post">
	<p><input type="text" name="nombre" placeholder="Nombre del autor" required pattern="[a-zA-Z]{1,25}" title="Solo letras en el nombre"></p>
	<p><input type="text" name="apellidos" placeholder="Apellidos del autor" required pattern="[a-zA-Z\s]+" title="Solo letras en los apellidos"></p>
	<p><input type="submit" value="Añadir">
		<input type="reset" value="Borrar"></p>
</form>

