<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(isset($_POST['desplegable'])){

		$cod_revista = $_POST['desplegable'];

		$consulta2 = "DELETE FROM revistas WHERE cod_revista=$cod_revista;";

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

	$consulta = "SELECT * FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	echo("
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h4 class='modal-title'>Eliminar una revista</h4>
				</div>
				<div class='modal-body'>
					<form action='bajaRevista.php' method='post' onsubmit='return seleccionado();'>
						<div class='form-group'>
							<select id='selec' name='desplegable'>
								<option value='vacio' selected>Selecciona una revista</option>
	");

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
									<option value='".$dato['cod_revista']."'>".$dato['numero']." ".$dato['fecha']."</option>
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
	");

?>