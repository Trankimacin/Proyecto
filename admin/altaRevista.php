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
					echo ("
					    <div class='alert alert-success fade in'>
						      <a href='' class='close' data-dismiss='alert'>&times;</a>
						      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
						      Revista a&ntilde;adida correctamente
						  </div>
					");
				}else{
					echo ("
						  <div class='alert alert-danger fade in'>
						      <a href='' class='close' data-dismiss='alert'>&times;</a>
						      <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						      No se ha podido a&ntilde;adir la revista
						  </div>
					");
				}
			}else{
				echo ("<h2>No se ha podido hacer la inserci&oacute;n</h2>");
			}
		}
	}

?>

<div class='container'>

<form class='form-horizontal' name='revista' action="altaRevista.php" method="post" enctype="multipart/form-data" onsubmit="return subido();">

	<fieldset>
		<legend>A&ntilde;adir Revista</legend>

		<!--Número de revista-->
		<div class='form-group'>
			<label class='col-md-4 control-label' for='numero'>N&uacute;mero de revista</label>
			<div class='col-md-4'>
				<input id='numero' name='numero' type='number' class='form-control input-md' required>
			</div>
		</div>

		<!--Fecha-->
		<div class='form-group'>
			<label class='col-md-4 control-label' for='fecha'>Fecha de publicaci&oacute;n</label>
			<div class='col-md-4'>
				<input type='text' id='fecha' name='fecha' class='form-control input-md' required>
			</div>
		</div>
		
		<!--Archivo-->
		<div class='form-group'>
			<label class='col-md-4 control-label' for='archivo' name='archivo'>Portada</label>
			<div class='col-md-4'> 
				<input type='file' name='archivo' id='archivo' class='input-file'>
			</div>
		</div>

		<!--Botones-->
		<div class='form-group'>
			<label class='col-md-4 control-label'></label>
			<div class='col-md-8'>
				<button class='btn btn-success'>A&ntilde;adir</button>
				<button class='btn btn-danger'>Borrar</button>
			</div>
		</div>
	</fieldset>
</form>
</div>