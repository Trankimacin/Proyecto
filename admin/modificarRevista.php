<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['cod_revista'])){
		if(empty($_FILES['archivo']['name'])){

			$cod_revista = $_POST['cod_revista'];
			$numero      = $_POST['numero'];
			$fecha       = $_POST['fecha'];
			$portada     = $_POST['portada'];
			$publicada   = $_POST['publicada'];

			$consulta = "UPDATE revistas SET numero='$numero', fecha='$fecha', portada='$portada', publicada=$publicada WHERE cod_revista='$cod_revista';";
			mysqli_query($conexion, $consulta);

			if(mysqli_errno($conexion)==0){
				echo ("<h2>Revista actualizada correctamente</h2>");
			}else{
				echo ("<h2>La revista no se pudo actualizar</h2>");
			}

		}else{
			
			$info = getimagesize($_FILES['archivo']['tmp_name']);

			if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG) && $_FILES['archivo']['size']<=1048576) {
  				echo ("<h2>Solo se admiten lo siguientes archivos: .gif / .jpeg / .png");
  			}else{

				$archivo = $_FILES['archivo']['tmp_name'];
				$destino = '../media/img/portadas/' .$_FILES['archivo']['name'];
				$nombre  = $_FILES['archivo']['name'];

				if(move_uploaded_file($archivo, $destino)){
					$cod_revista = $_POST['cod_revista'];
					$numero      = $_POST['numero'];
					$fecha       = $_POST['fecha'];
					$publicada   = $_POST['publicada'];

					$consulta = "UPDATE revistas SET numero='$numero', fecha='$fecha', portada='$nombre', publicada=$publicada WHERE cod_revista='$cod_revista';";

					mysqli_query($conexion, $consulta);

					if(mysqli_errno($conexion)==0){
						echo ("<h2>Revista actualizada correctamente</h2>");
					}else {
						echo ("<h2>La revista no se pudo actualizar</h2>");
					}

				}else{
					echo ("<h2>No se pudo hacer la modificación</h2>");
				}

  			}
		}

	}

	if(isset($_POST['desplegable'])){

		$cod_revista = $_POST['desplegable'];

		$consulta = "SELECT * FROM revistas WHERE cod_revista='$cod_revista';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Modifica la revista</h2>

			<form name='formulario' action='modificarRevista.php' method='post' enctype='multipart/form-data'>
		");

		while($dato=mysqli_fetch_array($resultado)){

			echo ("
				<input type='hidden' name='cod_revista' value='".$dato['cod_revista']."'>
				<p><label>Número de la revista</label>
				<input type='number' name='numero' value='".$dato['numero']."'></p>
				<p><label>Fecha: </label>
				<input type='text' name='fecha' value='".$dato['fecha']."'></p>
				<p><label>Portada: </label>
				<input type='text' name='portada' value='".$dato['portada']."' readonly></p>
				<p><label>Nueva portada</label>
				<input type='file' name='archivo' style='color: transparent;'></p>
				<div class='bloque'><label>Publicar:
					<div class='tooltip'><img src='../media/icon/info.png'>
						<span class='tooltiptext'>Cambiar a SI cuando se quiera publicar</span>
					</div>
				</div>
				</label></p>
				<p><input type='radio' name='publicada' value='0' checked>No
				<input type='radio' name='publicada' value='1'>Si</p>

			");
		}
			echo ("
				<input type='submit' value='Modificar' onclick='return confirm(\"¿Seguro que quiere modificarlo?\")'>
			</form>
			");
	}else{

		$consulta = "SELECT * FROM revistas ORDER BY numero;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Selecciona una revista para modificar</h2>

			<form name='modifica' method='post' action='modificarRevista.php'>
				<select name='desplegable'>
					<option value='vacio' selected>Selecciona una revista</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
				echo ("
					<option value='".$dato['cod_revista']."'>Revista: ".$dato['numero']." Fecha: ".$dato['fecha']."</option>
				");
		}
		echo ("
				</select>
				<input type='button' value='Modificar' onclick='seleccionado();''>
			</form>
		");
	}

?>