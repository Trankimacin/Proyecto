<?php
//require_once("sesion.php");
require_once("caducidad.php");
?>
<script>

	function validar(){
		if(document.cambiar_frm.pass_1.value.length!=8){
			alert("La contraseña debe tener 8 caracteres");
		}else if(document.cambiar_frm.pass_1.value!=document.cambiar_frm.pass_2.value){
			alert("Las contraseñas no coinciden");
		} else {
			document.cambiar_frm.submit();
		}
	}

</script>
<link rel="stylesheet" href="../css/estilos.css">

<?php

	echo ("<meta charset='utf-8'>");

	$usuario = $_SESSION['usuario'];

	echo ("

	<form name='cambiar_frm' action='grabarPass.php' method='post' enctype='application/x-www-form-urlencoded'>
		<div class='container'>
    	<label>Introduzca nueva contraseña: </label>
        <input type='password' name='pass_1' required autofocus placeholder='Introducir 8 caracteres' /><br /><br />

		<label>Repita contraseña: </label>
        <input type='password' name='pass_2' required placeholder='Introducir 8 caracteres' /><br /><br />

		<input type='button' name='enviar_btn' value='Enviar' onclick='validar();' />
		<input type='reset' value='Borrar' />
		</div>
	</form>

	");

?>