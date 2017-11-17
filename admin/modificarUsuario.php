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

	}


	if(isset($_POST['desplegable'])){

		$cod_usuario = $_POST['desplegable'];

		$consulta  = "SELECT * FROM usuarios WHERE cod_usuario='$cod_usuario';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2 class='medio'>Modifica usuario y/o contraseña</h2>

			<form name='formulario' action='modificarUsuario.php' method='post' onsubmit='validar(event)'>
		");

		while($dato=mysqli_fetch_array($resultado)){

			echo ("
			<div class='container'>
				<input type='hidden' name='cod_usuario' value='".$dato['cod_usuario']."'>
				<label>Usuario</label>
				<input type='text' name='user' value='".$dato['usuario']."'>
				<label>Password</label>
				<input type='password' id='pass_1' placeholder='Contraseña' name='pass_1'>
				<label>Password</label>
				<div class='tooltip'>
					<i class='fa fa-question'></i>
					<span class='tooltiptext'>Debe coincidir la contraseña</span>
				</div>
				<input type='password' id='pass_2' placeholder='Contraseña' name='pass_2'>
			");
		}
			echo ("
				<input type='submit' value='Modificar' onclick='return confirm(\"¿Seguro que quiere modificarlo?\")'>
			</div>
			</form>
			");
	}else{

		$consulta  = "SELECT * FROM usuarios ORDER BY usuario;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Selecciona un usuario para modificar</h2>
			<form name='modifica' action='modificarUsuario.php' method='post'>
				<select name='desplegable'>
					<option value='vacio' selected>Selecciona un usuario</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo ("
				<option value='".$dato['cod_usuario']."'>".$dato['usuario']."</option>
			");
		}

		echo ("
				</select>
				<input type='button' value='Modificar' onclick='return seleccionado();'/>
			</form>
		");
	}


?>