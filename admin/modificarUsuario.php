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
			echo ("<h2>El usuario se ha modificador correctamente</h2>");
		}else{
			echo ("<h2>El usuario no se pudo modificar</h2>");
		}

	}


	if(isset($_POST['desplegable'])){

		$cod_usuario = $_POST['desplegable'];

		$consulta  = "SELECT * FROM usuarios WHERE cod_usuario='$cod_usuario';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Modifica usuario y/o contraseña</h2>

			<form name='formulario' action='modificarUsuario.php' method='post' onsubmit='validar(event)'>
		");

		while($dato=mysqli_fetch_array($resultado)){

			echo ("
				<input type='hidden' name='cod_usuario' value='".$dato['cod_usuario']."'>
				<p><input type='text' name='user' value='".$dato['usuario']."'></p>
				<p><input type='password' id='pass_1' placeholder='Contraseña' name='pass_1'></p>
				<p><input type='password' id='pass_2' placeholder='Contraseña' name='pass_2'></p>
			");
		}
			echo ("
				<input type='submit' value='Modificar' onclick='return confirm(\"¿Seguro que quiere modificarlo?\")'>
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