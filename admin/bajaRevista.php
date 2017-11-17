<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['desplegable'])){

		$cod_revista = $_POST['desplegable'];

		$consulta2 = "DELETE FROM revistas WHERE cod_revista=$cod_revista;";

		$resultado2 = mysqli_query($conexion, $consulta2);

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

	$consulta = "SELECT * FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un revista para ser borrada</h1>");

	echo("
	<form name='modifica' action='bajaRevista.php' method='post'>
		<select name='desplegable'>
			<option value='vacio' selected>Selecciona un revista</option>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_revista']."'>".$dato['numero']." ".$dato['fecha']." ".$dato['portada']."</option>");
		}
	echo ("
		</select>
		<input type='button' value='Borrar' onclick='return seleccionado();'/>
	</form>
	");

?>