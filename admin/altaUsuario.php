<?php

	require_once("sesion.php");
	require_once("caducidad.php");
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
<script>
	function validar(){
		//Preguntamos si la contraseña tiene menos o más de 8 caracteres
		if(document.altaUsuario.pass_1.value.length!=8){
			alert("La contraseña debe tener 8 caracteres");
		//Comprobamos que las contraseñas sean iguales
		}else if(document.altaUsuario.pass_1.value!=document.altaUsuario.pass_2.value){
			alert("Las contraseñas no coinciden");
		} else {
			//Si todo sale bien enviamos el formulario
			document.altaUsuario.submit();
		}
	}
</script>

  
  <h2 class="login-header">Registrar nuevo usuario</h2>

  <form name="AltaUsuario" action="altaUsuario.php" method="post">
    <p><input type="text" placeholder="Usuario" name="usuario"></p>
    <p><input type="password" placeholder="Password" name="pass_1"></p>
    <p><input type="password" placeholder="Password" name="pass_2"></p>
    <p><input type="submit" value="Registrar" name="enviar_btn"></p>
  </form>
