<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['usuario'])){

		require_once("conexion.php");

		$usuario = $_POST['usuario'];
		$pass    = $_POST['pass_1'];

		$consulta = "INSERT INTO usuarios(usuario, pass, estado) VALUES ('$usuario', '$pass', '0');";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("<h2>Usuario introducido correctamente</h2>");
		}else{
			echo ("<h2>No se ha podido introducir el usuario</h2>");
		}

	}

?>
  
  <h2 class="login-header">Registrar nuevo usuario</h2>

  <form name="formulario" action="altaUsuario.php" method="post" onsubmit="validar(event)">
    <p><input type="text" placeholder="Usuario" name="usuario"></p>
    <p><input type="password" id="pass_1" placeholder="Password" name="pass_1"></p>
    <p><input type="password" id="pass_2" placeholder="Password" name="pass_2"></p>
    <p><input type="submit" value="Registrar"></p>
  </form>
