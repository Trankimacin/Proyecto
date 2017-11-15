<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['desplegable'])){

		$cod_articulo = $_POST['desplegable'];

		$consulta = "DELETE FROM articulos WHERE cod_articulo=$cod_articulo;";

		$resultado = mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("<h2>El articulo se ha borrado correctamente</h2>");
		}else{
			echo ("<h2>El articulo no se ha podido borrar</h2>");
		}
	}

	$consulta = "SELECT * FROM articulos ORDER BY titulo;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un articulo para ser borrado</h1>");

	echo("
	<form name='modifica' action='bajaArticulos.php' method='post'>
		<select name='desplegable'>
			<option value='vacio' selected>Selecciona un articulo</option>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_articulo']."'>".$dato['titulo']."</option>");
		}
	echo ("
		</select>
		<input type='button' value='Borrar' onclick='return seleccionado();'/>
	</form>
	");

?>