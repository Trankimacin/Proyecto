<?php

	require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_GET['usuario'])){

		$cod_usuario = $_GET['usuario'];
		$usuario     = $_SESSION['usuario'];
		
		$consulta    = "SELECT * FROM usuarios WHERE usuario=$usuario;";
		
		$resultado   = mysqli_query($conexion, $consulta);

			if($){
				echo ("<h2>No te puedes borrar a ti mismo</h2>");
			}else{

				$consulta = "DELETE FROM usuarios WHERE cod_usuario=$cod_usuario;";

				$resultado = mysqli_query($consulta);

				if(mysqli_errno($conexion)==0){
					echo ("<h2>El usuario se ha borrado correctamente</h2>");
				}else{
					echo ("<h2>El usuario no se ha podido borrar</h2>");
				}
			}
	}

	$consulta = "SELECT * FROM usuarios;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un usuario para ser borrado</h1>");

	echo("
	<form action='bajaUsuario.php' method='get'>
		<select name='usuario'>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_usuario']."'>".$dato['usuario']."</option>");
		}
	echo ("
		</select>
		<input type='submit' value='Borrar' />
	</form>
	");