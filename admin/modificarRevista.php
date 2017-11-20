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
				echo ("<div class='success-msg'>
						<i class='fa fa-check'></i>
						Se ha modificado correctamente
						</div>
				");
			}else{
				echo ("<div class='error-msg'>
						<i class='fa fa-times-circle'></i>
						No se pudo modificar
						</div>");
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
						echo ("<div class='success-msg'>
								<i class='fa fa-check'></i>
								Se ha modificado correctamente
								</div>
						");
					}else{
						echo ("<div class='error-msg'>
								<i class='fa fa-times-circle'></i>
								No se pudo modificar
								</div>");
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
			<div class='wrapper'>

			<h2 id='account'>Modificar revista</h2>

			<form name='formulario' action='modificarRevista.php' method='post' enctype='multipart/form-data'>
			<div class='info'>
			<h3>Datos</h3>
		");

		while($dato=mysqli_fetch_array($resultado)){
			$publicada = $dato['publicada'];

			echo ("
				<input type='hidden' name='cod_revista' value='".$dato['cod_revista']."'>
				<label for='numero'>Número de la revista</label>
				<input type='number' id='numero' name='numero' value='".$dato['numero']."'>
				<label id='fecha'>Fecha</label>
				<input type='text' id='fecha' name='fecha' value='".$dato['fecha']."'>
				<label>Portada</label>
				<input type='text' name='portada' value='".$dato['portada']."' readonly>
				<label for='nueva'>Nueva portada</label>
				<input type='file' id='nueva' name='archivo'>
				<label class='empty'>Publicada</label>
				<fieldset>
				<legend>Publicada</legend>
				<span class='bloque2'>
				<input type='radio' id='no' name='publicada' value='0'
			");if($publicada==0){echo ("checked");}
				echo ("
				>
				<span class='radio'></span>
				<label for='no'>No</label>
				</span>
				<span class='bloque2'>
				<input type='radio' id='si' name='publicada' value='1'
				");if($publicada==1){echo ("checked");}
				echo ("
				>
				<span class='radio'></span>
				<label for='si'>Si</label>
				</span>
				</fieldset>
				");
		}
			echo ("
				<div class='buttons'>
				<input type='submit' value='modificar' onclick='return confirm(\"¿Seguro que quiere modificarlo?\")'/>
				</div>
			</div>
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
				<input type='button' value='Modificar' onclick='seleccionado();'>
			</form>
		");
	}

?>