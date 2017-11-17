<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	require_once("conexion.php");
	include_once("menu.php");

	if(isset($_POST['cod_autor'])){

		$cod_autor = $_POST['cod_autor'];
		$nombre    = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];

		$consulta = "UPDATE autores SET nombre='$nombre', apellidos='$apellidos' WHERE cod_autor='$cod_autor';";

		mysqli_query($conexion, $consulta);
		
		if(mysqli_errno($conexion)==0){
			echo ("<div class='success-msg'>
					<i class='fa fa-check'></i>
					Se ha modificado correctamente
					</div>
			");
		}else{
			echo ("<div class='error-msg'>
					<i class='fa fa-times-circle'></i>
					No se pudo modificar
					</div>
			");
		}

	}


	if(isset($_POST['desplegable'])){

		$cod_autor = $_POST['desplegable'];

		$consulta  = "SELECT * FROM autores WHERE cod_autor='$cod_autor';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2 class='medio'>Modifica el autor</h2>

			<form name='modificaAutor' action='modificarAutores.php' method='post'>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo ("
			<div class='container'>
				<input type='hidden' name='cod_autor' value='".$dato['cod_autor']."'>
				<label>Nombre</label>
				<input type='text' name='nombre' value='".$dato['nombre']."' required pattern='[a-zA-Z]{1,25}' title='Solo letras en el nombre'>
				<label>Apellidos</label>
				<input type='text' name='apellidos' value='".$dato['apellidos']."' required pattern='[a-zA-Z\s]+' title='Solo letras en los apellidos'>
			");
		}
			echo ("
				<input type='submit' value='Modificar' onclick='return confirm(\"¿Seguro que quiere modificarlo?\")'>
			</div>
			</form>
			");
	}else{
		$consulta  = "SELECT * FROM autores ORDER BY nombre, apellidos;";
		$resultado = mysqli_query($conexion, $consulta);
		
		echo ("
			<h2>Selecciona un autor para modificar</h2>
			<form name='modifica' action='modificarAutores.php' method='post'>
				<select name='desplegable'>
					<option value='vacio' selected>Selecciona un autor</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo ("
				<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>
			");
		}

		echo ("
				</select>
				<input type='button' value='Modificar' onclick='return seleccionado();'/>
			</form>
		");
	}

?>