<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['usuario'])){

		require_once("conexion.php");

		$usuario = $_POST['usuario'];
		$pass    = $_POST['pass_1'];

		$consulta = "INSERT INTO usuarios(usuario, pass, estado) VALUES ('$usuario', '$pass', '0');";

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

	}

?>
  
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Añadir un usuario</h4>
			</div><!-- Termina la cabecera -->
			<div class="modal-body">
				<form action="altaUsuario.php" method="post" onsubmit="return validar();">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario"/>
							<label for="usuario" class="input-group-addon glyphicon glyphicon-user"></label>
						</div>
					</div><!-- Termina el DIV de usuario-->
					<div class="form-group">
						<div class="input-group">
							<input type="password" name="pass_1" class="form-control" id="pass_1" placeholder="Password"/>
							<label for="pass_1" class="input-group-addon glyphicon glyphicon-lock"></label>
						</div>
					</div><!-- Termina el DIV de la primera password-->
					<div class="form-group">
						<div class="input-group">
							<input type="password" name="pass_2" class="form-control" id="pass_2" placeholder="Password"/>
							<label for="pass_2" class="input-group-addon glyphicon glyphicon-lock"></label>
						</div>
						<span id="helpBlock" class="help-block">Debe coincidir las contraseña</span>
					</div><!--Termina el DIV de la segunda password-->
					<button class="form-control btn btn-success">Registrar</button>
				</form>
			</div><!--Termina el body-->
		</div><!--Termina el modal-content-->
	</div><!--Termina el div para el formulario-->