<?php
//require_once("sesion.php");
require_once("caducidad.php");
?>
<script>

function validar(){
	var pass1 = document.getElementById("pass_1").value;
	var pass2 = document.getElementById("pass_2").value;
	if(pass1.length < 8){
		alert("La contraseña debe tener 8 caracteres");
		return false;
	}else if(pass1!=pass2){
		alert("Las contraseñas no coinciden");
		return false;
	}
	return true;
}

</script>
<link rel="stylesheet" href="../css/estilos.css">

<?php

	echo ("<meta charset='utf-8'>");

	$usuario = $_SESSION['usuario'];

	echo ("

	<form name='cambiar_frm' action='grabarPass.php' method='post' onsubmit='return validar();'>
		<div class='container'>
    	<label>Introduzca nueva contraseña: </label>
        <input type='password' id='pass_1' name='pass_1' required autofocus placeholder='Introducir 8 caracteres' /><br /><br />

		<label>Repita contraseña: </label>
        <input type='password' id='pass_2' name='pass_2' required placeholder='Introducir 8 caracteres' /><br /><br />

		<input type='submit' name='enviar_btn' value='Enviar' />
		</div>
	</form>

	");

?>