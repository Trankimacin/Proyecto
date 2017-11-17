<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['usuario'])){

		require_once("conexion.php");

		$usuario = $_POST['usuario'];
		$pass    = $_POST['pass_1'];

		$consulta = "INSERT INTO usuarios(usuario, pass, estado) VALUES ('$usuario', '$pass', '0');";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("<div class='success-msg'>
					<i class='fa fa-check'></i>
					Se ha añadido correctamente
					</div>
			");
		}else{
			echo ("<div class='error-msg'>
					<i class='fa fa-times-circle'></i>
					No se pudo añadir
					</div>");
		}

	}

?>
  
  <h2 class="login-header">Registrar nuevo usuario</h2>

  <form name="formulario" action="altaUsuario.php" method="post" onsubmit="validar(event)">
	<div class="bloque">
	  	<input type="text" placeholder="Usuario" name="usuario">
	    	<div class="tooltip">
	    		<i class="fa fa-question"></i>
	    			<span class="tooltiptext">Introduce un correo</span>
	    	</div>
    </div>
    <div class="bloque">
	    <input type="password" id="pass_1" placeholder="Password" name="pass_1">
	    	<div class="tooltip">
	    		<i class="fa fa-question"></i>
	    			<span class="tooltiptext">Introduce una contraseña</span>
	    	</div>
    </div>
    <div class="bloque">
		<input type="password" id="pass_2" placeholder="Password" name="pass_2">
			<div class="tooltip">
				<i class="fa fa-question"></i>
					<span class="tooltiptext">Repite contraseña</span>
			</div>
	</div>
	</div>
    <p><input type="submit" value="Registrar"></p>
  </form>