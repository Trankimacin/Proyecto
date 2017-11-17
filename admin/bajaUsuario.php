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
			echo ("<div class='warning-msg'>
						<i class='fa fa-warning'></i>
						No puedes borrar el mismo usuario con el que estas logeado
						</div>");
		}else{

			$consulta2 = "DELETE FROM usuarios WHERE cod_usuario=$cod_usuario;";

			$resultado2 = mysqli_query($conexion, $consulta2);

			if(mysqli_errno($conexion)==0){
				echo ("<div class='success-msg'>
						<i class='fa fa-check'></i>
						Se ha borrado correctamente
						</div>
				");
			}else{
				echo ("<div class='error-msg'>
						<i class='fa fa-times-circle'></i>
						No se pudo borrar
						</div>");
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