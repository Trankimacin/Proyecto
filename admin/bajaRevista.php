<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['revista'])){

		$cod_revista = $_POST['revista'];

		if($cod_revista=='vacio'){
			echo ("<h2>Selecciona un revista de la lista</h2>");
		}else{

			$consulta2 = "DELETE FROM revistas WHERE cod_revista=$cod_revista;";

			$resultado2 = mysqli_query($conexion, $consulta2);

			if(mysqli_errno($conexion)==0){
				echo ("<h2>La revista se ha borrado correctamente</h2>");
			}else{
				echo ("<h2>La revista no se ha podido borrar</h2>");
			}
		}
	}

	$consulta = "SELECT * FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un revista para ser borrada</h1>");

	echo("
	<form action='bajaRevista.php' method='post'>
		<select name='revista'>
			<option value='vacio' selected>Selecciona un revista</option>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_revista']."'>".$dato['numero']." ".$dato['fecha']." ".$dato['portada']."</option>");
		}
	echo ("
		</select>
		<input type='submit' value='Borrar' onclick='return confirm(\"¿Seguro que quiere borrarlo?\")'/>
	</form>
	");

?>