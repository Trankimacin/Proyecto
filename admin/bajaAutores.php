<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['desplegable'])){

		$cod_autor = $_POST['desplegable'];

		$consulta = "DELETE FROM autores WHERE cod_autor=$cod_autor;";

		$resultado = mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("<div class='success-msg'>
					<i class='fa fa-check'></i>
					Se ha borrado correctamente
					</div>
			");
		}else{
			echo ("<div class='error-msg'>
					<i class='fa fa-times-circle'></i>
					No se pudo borrar
					</div>");
		}
	}

	$consulta = "SELECT * FROM autores ORDER BY nombre, apellidos;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un autor para ser borrado</h1>");

	echo("
	<form name='modifica' action='bajaAutores.php' method='post'>
		<select name='desplegable'>
			<option value='vacio' selected>Selecciona un autor</option>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>");
		}
	echo ("
		</select>
		<input type='button' value='Borrar' onclick='return seleccionado();'/>
	</form>
	");

?>