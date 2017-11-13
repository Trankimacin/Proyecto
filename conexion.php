<?php

	$servidor = "localhost";
	$usuario  = "root";
	$password = "root";
	$bbdd     = "proyecto";

	$conexion = mysqli_connect($servidor, $usuario, $password);

	mysqli_select_db($conexion, $bbdd);

?>