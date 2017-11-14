<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['autor'])){

		$cod_autor = $_POST['autor'];

		if($cod_autor=='vacio'){
			echo ("<h2>Selecciona un autor de la lista</h2>");
		}else{

			$consulta = "DELETE FROM autores WHERE cod_autor=$cod_autor;";

			$resultado = mysqli_query($conexion, $consulta);

			if(mysqli_errno($conexion)==0){
				echo ("<h2>El autor se ha borrado correctamente</h2>");
			}else{
				echo ("<h2>El autor no se ha podido borrar</h2>");
			}
		}
	}

	$consulta = "SELECT * FROM autores ORDER BY nombre, apellidos;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un autor para ser borrado</h1>");

	echo("
	<form action='bajaAutores.php' method='post'>
		<select name='autor'>
			<option value='vacio' selected>Selecciona un autor</option>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>");
		}
	echo ("
		</select>
		<input type='submit' value='Borrar' onclick='return confirm(\"¿Seguro que quiere borrarlo?\")'/>
	</form>
	");

?>