<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['desplegable'])){

		$consulta2 = "DELETE FROM usuarios WHERE cod_usuario=$cod_usuario;";

		$resultado2 = mysqli_query($conexion, $consulta2);

		if(mysqli_errno($conexion)==0){
			echo ("
				<div class='alert alert-success fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
					Se ha eliminado correctamente
				</div>
			");
		}else{
			echo ("
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					No se ha podido eliminar
				</div>
			");
		}
	}

	$usuario = $_SESSION['usuario'];

	$consulta = "SELECT * FROM usuarios WHERE usuario != '$usuario' ORDER BY usuario;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("
	<div class='container'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h4 class='modal-title'>Eliminar un usuario <a href='#' data-trigger='focus' data-toggle='borrar' data-content='Nunca podrás borrarte a ti mismo' class='glyphicon glyphicon-cog'></a></h4>
				</div>
				<div class='modal-body'>
					<form action='bajaUsuario.php' method='post' onsubmit='return seleccionado();'>
						<div class='form-group'>
							<select id='selec' name='desplegable'>
								<option value='vacio' selected>Selecciona un usuario</option>
	");

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
									<option value='".$dato['cod_usuario']."'>".$dato['usuario']."</option>
		");
	}

	echo ("
							</select>
						</div>
						<button class='form-control btn btn-danger'/>Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	");

?>

<script>
$(document).ready(function(){
    $('[data-toggle="borrar"]').popover();
});
</script>