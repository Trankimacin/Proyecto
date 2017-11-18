<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['numero'])){

		require_once("conexion.php");

		//Para subir la imagen al servidor

		$archivo = $_FILES['archivo']['tmp_name'];
		$destino = '../media/img/portadas/' .$_FILES['archivo']['name'];
		$nombre  = $_FILES['archivo']['name'];

		$info = getimagesize($_FILES['archivo']['tmp_name']);

		if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG) && $_FILES['archivo']['size']<=1048576) {
  			echo ("<div class='warning-msg'>
				<i class='fa fa-warning'></i>
  				Solo se admiten lo siguientes archivos: .gif / .jpeg / .png</div>");
  		}else{

			if(move_uploaded_file($archivo, $destino)){
				$numero = $_POST['numero'];
				$fecha  = $_POST['fecha'];

				$consulta = "INSERT INTO revistas(numero, fecha, portada, publicada) VALUES ('$numero', '$fecha', '$nombre', 0);";

				mysqli_query($conexion, $consulta);

				if(mysqli_errno($conexion)==0){
					echo ("<div class='success-msg'>
							<i class='fa fa-check'></i>
							Se ha añadido correctamente
							</div>
					");
				}else{
					echo ("<div class='error-msg'>
							<i class='fa fa-times-circle'></i>
							No se pudo añadir
							</div>");
				}
			}else{
				echo ("<h2>No se ha podido hacer la inserción</h2>");
			}
		}
	}

?>

<div class="wrapper">

	<h2 id="account">Añadir nueva revista</h2>

	<form name="revista" action="altaRevista.php" method="post" enctype="multipart/form-data" onsubmit="return subido()">
	<div class="info">
		<h3>Datos</h3>
		<!--Número Revista-->
		<label for="numero">Número de revista</label>
			<input id="numero" type="number" name="numero" required>
		<!--Fecha-->
		<label for="fecha">Fecha de públicación</label>
		<input id="fecha" type="text" id="fecha" required>
		<!--Archivo-->
		<label for="archivo">Portada</label>
		<input id="archivo" type="file" name="archivo">
		<div class="buttons">
			<input type="submit" value="Añadir">
			<input type="reset" value="Borrar">
		</div>
	</div>
	</form>
</div>