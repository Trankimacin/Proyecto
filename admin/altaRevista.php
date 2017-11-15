<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['numero'])){

		require_once("conexion.php");

		//Para subir la imagen al servidor

		$archivo = $_FILES['archivo']['tmp_name'];
		$destino = '../media/img/portadas/' .$_FILES['archivo']['name'];
		$nombre = $_FILES['archivo']['name'];

		$info = getimagesize($_FILES['archivo']['tmp_name']);

		if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
  			echo ("<h2>Solo se admiten lo siguientes archivos: .gif / .jpeg / .png");
  		}else{

			if(move_uploaded_file($archivo, $destino)){
				$numero = $_POST['numero'];
				$fecha = $_POST['fecha'];

				$consulta = "INSERT INTO revistas(numero, fecha, portada, publicada) VALUES ('$numero', '$fecha', '$nombre', 0);";

				mysqli_query($conexion, $consulta);

				if(mysqli_errno($conexion)==0){
					echo ("<h2>Revista agregada correctamente</h2>");
				}else{
					echo ("<h2>No se pudo insertar la revista</h2>");
				}
			}else{
				echo ("<h2>No se ha podido hacer la inserción</h2>");
			}
		}
	}

?>

	<h2>Añadir nueva revista</h2>

	<form name="revista" action="altaRevista.php" method="post" enctype="multipart/form-data">
		<p><input type="number" placeholder="Número de revista" name="numero" required></p>
		<p><input type="text" id="fecha" placeholder="Fecha" name="fecha" required></p>
		<p><input type="file" name="archivo" style="color: transparent;"></p>
		<p><input type="submit" value="Enviar">
		<input type="reset" value="Borrar"></p>
	</form>

	<script type="text/javascript">
		var input = document.getElementById('fecha');
		input.oninvalid = function(event) {
  		  event.target.setCustomValidity('Formato válido: DD/MM/AAAA');
		}
	</script>