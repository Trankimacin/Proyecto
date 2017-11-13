<?php

	if (isset($_POST["enviar_btn"])){

		$servidor = "localhost";
		$usuario  = "root";
		$password = "root";
		$bbdd     = "proyecto";

		$conexion = mysqli_connect($servidor, $usuario, $password);

		mysqli_select_db($conexion, $bbdd);

		$usuario = $_POST["usuario_txt"];
		$pass    = $_POST["pass_txt"];

		$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$pass';";

		$resultado = mysqli_query($conexion, $consulta);

		if($dato=mysqli_fetch_array($resultado)){

			session_start();
			$_SESSION["logueado"] = TRUE;
			$_SESSION["usuario"]  = $_POST["usuario_txt"];
			$_SESSION["hora"]     = time();
			
			if($dato['estado']=="0"){

				header("Location:cambiarPass.php");
			} else {
				header("Location:altaRevista.php");
			}
		} else {

			header("Location:login.php?mensaje=error");
		}

	}else{

		header("Location:login.php");
	}
?>