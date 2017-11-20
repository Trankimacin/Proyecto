<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	require_once("conexion.php");
	include_once("menu.php");

	if(isset($_POST['cod_usuario'])){

		$cod_usuario = $_POST['cod_usuario'];
		$user        = $_POST['user'];
		$pass1       = $_POST['pass_1'];

		$consulta = "UPDATE usuarios SET usuario='$user', pass='$pass1' WHERE cod_usuario=$cod_usuario;";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("
				<div class='alert alert-success fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
					Se ha modificado correctamente
				</div>
			");
		}else{
			echo ("
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					Se ha modificado correctamente
				</div>
			");
		}

	}


	if(isset($_POST['desplegable'])){

		$cod_usuario = $_POST['desplegable'];

		$consulta  = "SELECT * FROM usuarios WHERE cod_usuario='$cod_usuario';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Modifica usuario y/o contraseña</h4>
					</div>
					<div class='modal-body'>
						<form name='formulario' action='modificarUsuario.php' method='post' onsubmit='validar()'>
							<div class='form-group'>
								<div class='input-group'>
		");

		while($dato=mysqli_fetch_array($resultado)){

			echo ("
									<input type='hidden' name='cod_usuario' value='".$dato['cod_usuario']."'>
									<input type='text' name='user' id='user' class='form-control' value='".$dato['usuario']."'>
									<label for='user' class='input-group-addon glyphicon glyphicon-user'></label>
								</div>
							</div>
							<div class='form-group'>
								<div class='input-group'>
									<input type='password' id='pass_1' class='form-control' placeholder='Contraseña' name='pass_1'>
									<label for='pass_1' class='input-group-addon glyphicon glyphicon-lock'></label>
								</div>
							</div>
							<div class='form-group'>
								<div class='input-group'>
									<input type='password' id='pass_2' class='form-control' placeholder='Contraseña' name='pass_2'>
									<label for='pass_2' class='input-group-addon glyphicon glyphicon-lock'></label>
								</div>
								<span id='helpBlock' class='help-block'>Deben coincidir las contraseñas</span>
							</div>
			");
		}
			echo ("
							<button class='form-control btn btn-warning'>Modificar</button>
						</form>
					</div>
				</div>
			</div>
			");
	}else{

		$consulta  = "SELECT * FROM usuarios ORDER BY usuario;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Modificar usuario</h4>
					</div>
					<div class='modal-body'>
						<form action='modificarUsuario.php' method='post' onsubmit='return seleccionado();'>
							<div class='form-group'>
								<select id='selec' name='desplegable'>
									<option value='vacio' selected>Selecciona un usuario</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo ("
										<option value='".$dato['cod_usuario']."'>".$dato['usuario']."</option>
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
		");
	}


?>