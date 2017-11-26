<?php
//require_once('sesion.php');
require_once('caducidad.php');
	echo ("<meta charset='utf-8'>");

	$usuario = $_SESSION['usuario'];
?>
<script>

function validar(){
	var pass1 = document.getElementById('pass_1').value;
	var pass2 = document.getElementById('pass_2').value;
	if(pass1.length < 8){
		alert('La contraseña debe tener 8 caracteres');
		return false;
	}else if(pass1!=pass2){
		alert('Las contraseñas no coinciden');
		return false;
	}
	return true;
}

</script>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

<!-- JQuery -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<!-- JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

<div class='container'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title'>Selecciona una nueva contrase&ntilde;a</h4>
			</div><!-- Termina la cabecera -->
			<div class='modal-body'>
				<form action='grabarPass.php' method='post' onsubmit='return validar();'>
					<div class='form-group'>
						<div class='input-group'>
							<input type='password' name='pass_1' class='form-control' id='pass_1' placeholder='Password'/>
							<label for='pass_1' class='input-group-addon glyphicon glyphicon-lock'></label>
						</div>
					</div><!-- Termina el DIV de la primera password-->
					<div class='form-group'>
						<div class='input-group'>
							<input type='password' name='pass_2' class='form-control' id='pass_2' placeholder='Password'/>
							<label for='pass_2' class='input-group-addon glyphicon glyphicon-lock'></label>
						</div>
						<span id='helpBlock' class='help-block'>Deben coincidir las contrase&ntilde;as</span>
					</div><!--Termina el DIV de la segunda password-->
					<button class='form-control btn btn-warning'>Modificar</button>
				</form>
			</div><!--Termina el body-->
		</div><!--Termina el modal-content-->
	</div><!--Termina el div para el formulario-->
</div>