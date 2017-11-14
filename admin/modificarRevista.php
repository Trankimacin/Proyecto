<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['cod_revista'])){


	}

	if(isset($_POST['revista'])){

		$cod_revista = $_POST['revista'];

		if($cod_revista=='vacio'){
			echo ("<h2>Selecciona una revista de la lista</h2>");
		}else{
			$consulta = "SELECT * FROM revistas WHERE cod_revista='$cod_revista';";
			$resultado = mysqli_query($conexion, $consulta);

			echo ("
				<h2>Modifica la revista</h2>

				<form name='formulario' action='modificarRevista.php' method='post'>
			");

			while($dato=mysqli_fetch_array($resultado)){

				echo ("
					<input type='hidden' name='cod_revista' value='".$dato['cod_revista']."'>
					<p><label>Número de la revista</label>
					<input type='number' name='numero' value='".$dato['numero']."'></p>
					<p><label>Fecha: </label>
					<input type='text name='fecha' value='".$dato['fecha']."'></p>
					<p><label>Portada: </label>
					<input type='text' name='portada' value='".$dato['portada']."' disabled></p>
					<p><label>Nueva portada</label>
					<input type='file' name='archivo' style='color: transparent;'></p>
					<p><label>Públicar</label></p>
					<p><input type='radio' name='publicada' value='0' checked>No
					<input type='radio' name='publicada' value='1'>Si</p>

				");
			}
				echo ("
					<input type='submit' value='Modificar' onclick='return confirm(\"¿Seguro que quiere modificarlo?\")'>
				</form>
				");
		}

	}else{

		$consulta = "SELECT * FROM revistas ORDER BY numero;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Selecciona una revista para modificar</h2>

			<form name='modificaRevista' method='post' action='modificarRevista.php'>
				<select name='revista'>
					<option value='vacio' selected>Selecciona una revista</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
				echo ("
					<option value='".$dato['cod_revista']."'>".$dato['numero']." ".$dato['fecha']." ".$dato['portada']."</option>
				");
		}
		echo ("
				</select>
				<input type='submit' value='Modificar'>
			</form>
		");
	}

?>