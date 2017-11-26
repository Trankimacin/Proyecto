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
				echo ("
				    <div class='alert alert-success fade in'>
				      	<a href='' class='close' data-dismiss='alert'>&times;</a>
				     	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
				     	Modificada correctamente
				  	</div>
				");
			}else{
				echo ("
					  <div class='alert alert-danger fade in'>
					      <a href='' class='close' data-dismiss='alert'>&times;</a>
					      <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					    	No se ha podido modificar
					  </div>
				");

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
						echo ("
						    <div class='alert alert-success fade in'>
						      	<a href='' class='close' data-dismiss='alert'>&times;</a>
						      	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
						      	Todo ha salido bien
						 	</div>
						");
					}else{
						echo ("
					  		<div class='alert alert-danger fade in'>
						      	<a href='' class='close' data-dismiss='alert'>&times;</a>
						      	<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						    	No se ha podido modificar
						  	</div>	
						");
					}
				}else{
					echo ("<h2>No se pudo hacer la modificaci&oacute;n</h2>");
				}

  			}
		}

	}

	if(isset($_POST['desplegable'])){

		$cod_revista = $_POST['desplegable'];

		$consulta = "SELECT * FROM revistas WHERE cod_revista='$cod_revista';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
		<div class='container'>
			<form name='formulario' class='form-horizontal' action='modificarRevista.php' method='post' enctype='multipart/form-data'>
			<fieldset>
			<legend>Modificar Revista</legend>
		");

		while($dato=mysqli_fetch_array($resultado)){
			$publicada = $dato['publicada'];

			echo ("
				<input type='hidden' name='cod_revista' value='".$dato['cod_revista']."'>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='numero'>N&uacute;mero de revista</label>
					<div class='col-md-4'>
						<input id='numero' name='numero' type='number' class='form-control input-md' value='".$dato['numero']."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='fecha'>Fecha de publicaci&oacute;n</label>
					<div class='col-md-4'>
						<input type='text' id='fecha' name='fecha' class='form-control input-md' value='".$dato['fecha']."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='portada'>Portada</label>
					<div class='col-md-4'>
						<input id='portada' name='portada' type='text' class='form-control input-md' value='".$dato['portada']."' readonly>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='nueva' name='nueva'>Portada</label>
					<div class='col-md-4'> 
						<input type='file' name='nueva' id='nueva' class='input-file'>
						<span class='help-block'>Subir nuevo archivo solo si se quiere cambiar la portada</span>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='publicada'>Publicada</label>
					<div class='col-md-4'>
					<div class='radio'>
					<label for='no'>
						<input type='radio' id='no' name='publicada' value='0'
			");if($publicada==0){echo ("checked");}
				echo ("
				>No
					</label>
					</div>
					<div class='radio'>
					<label for='si'>
						<input type='radio' id='si' name='publicada' value='1'
				");if($publicada==1){echo ("checked");}
				echo ("
				>Si
					</label>
					</div>
					</div>
				</div>
				");
		}
			echo ("
				<div class='form-group'>
				<label class='col-md-4 control-label'></label>
				<div class='col-md-8'>
				<button class='btn btn-success'>Modificar</button>
				</div>
				</div>
				</fieldset>
				</form>
			</div>
			");
	}else{

		$consulta = "SELECT * FROM revistas ORDER BY numero;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
		<div class='container'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Modificar revista</h4>
					</div>
					<div class='modal-body'>
						<form action='modificarRevista.php' method='post' onsubmit='return seleccionado();'>
							<div class='form-group'>
								<select id='selec' name='desplegable'>
									<option value='vacio' selected>Selecciona una revista</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
				echo ("
					<option value='".$dato['cod_revista']."'>Revista: ".$dato['numero']." Fecha: ".$dato['fecha']."</option>
				");
		}
		echo ("
								</select>
							</div>
							<button class='form-control btn btn-primary'/>Modificar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		");
	}

?>