<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	require_once("conexion.php");
	include_once("menu.php");

	if(isset($_POST['desplegable'])){

		$cod_articulo = $_POST['desplegable'];

		$consulta = "SELECT * FROM articulos, revistas WHERE cod_articulo='$cod_articulo' AND articulos.cod_revista=revistas.cod_revista;";

		$resultado = mysqli_query($conexion, $consulta);

		while($dato=mysqli_fetch_array($resultado)){
			echo("
				<form name='modificar' action='modificarArticulos.php' method='post' enctype='multipart/form-data'>
				<input type='hidden' value='".$dato['cod_articulo']."'>
				<p><label>Título</label>
				<input type='text' name='titulo' value='".$dato['titulo']."'></p>
				<p><label>Entradilla: </label>
				<textarea cols='40' rows='6' name='entradilla' naxlength='250''>".$dato['entradilla']."</textarea></p>
				<p><label>Texto: </label>
				<textarea cols='40' rows='6' name='texto'>".$dato['texto']."</textarea></p>
			");
		}

	}else{

		$consulta = "SELECT * FROM articulos ORDER BY titulo;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Selecciona un articulo para modificar</h2>
			<form name='modifica' method='post' action='modificarArticulos.php'>
				<select name='desplegable'>
					<option value='vacio' selected>Selecciona un articulo</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo("
					<option value='".$dato['cod_articulo']."'>".$dato['titulo']."</option>
			");
		}

		echo("
				</select>
				<input type='button' value='Modificar' onclick='return seleccionado();'>
			</form>
		");
	}

?>