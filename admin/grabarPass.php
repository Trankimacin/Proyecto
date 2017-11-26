<?php

	//require_once("sesion.php");
	require_once("caducidad.php");

		$pass = $_POST['pass_1'];

		require_once("conexion.php");

		$usuario = $_SESSION['usuario'];
		$consulta = "UPDATE usuarios SET pass='$pass', estado='1' WHERE usuario='$usuario';";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			header("Location:altaRevista.php?mensaje=ok");
		} else {
			session_destroy();
			header("Location:index.php?mensaje=error2");
		}

?>