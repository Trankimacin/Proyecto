<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['desplegable'])){

		$cod_usuario = $_POST['desplegable'];

		$usuario     = $_SESSION['usuario'];
		
		$consulta    = "SELECT cod_usuario FROM usuarios WHERE usuario='$usuario';";
		
		$resultado   = mysqli_query($conexion, $consulta);

		$dato = mysqli_fetch_assoc($resultado);

		if($dato['cod_usuario']==$cod_usuario){
			echo ("<h2>No puedes borrar el usuario con el que estas logeado</h2>");
		}else{

			$consulta2 = "DELETE FROM usuarios WHERE cod_usuario=$cod_usuario;";

			$resultado2 = mysqli_query($conexion, $consulta2);

			if(mysqli_errno($conexion)==0){
				echo ("<h2>El usuario se ha borrado correctamente</h2>");
			}else{
				echo ("<h2>El usuario no se ha podido borrar</h2>");
			}
		}
	}

	$consulta = "SELECT * FROM usuarios ORDER BY usuario;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("<h2>Selecciona un usuario para ser borrado</h1>");

	echo("
	<form name='modifica' action='bajaUsuario.php' method='post'>
		<select name='desplegable'>
			<option value='vacio' selected>Selecciona un usuario</option>
	");
		while ($dato=mysqli_fetch_array($resultado)){
			echo("<option value='".$dato['cod_usuario']."'>".$dato['usuario']."</option>");
		}
	echo ("
		</select>
		<input type='button' value='Borrar' onclick='return seleccionado();'/>
	</form>
	");

?>