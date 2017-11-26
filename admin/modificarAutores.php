<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	require_once("conexion.php");
	include_once("menu.php");

	if(isset($_POST['cod_autor'])){

		$cod_autor = $_POST['cod_autor'];
		$nombre    = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];

		$consulta = "UPDATE autores SET nombre='$nombre', apellidos='$apellidos' WHERE cod_autor='$cod_autor';";

		mysqli_query($conexion, $consulta);
		
		if(mysqli_errno($conexion)==0){
			echo ("
				<div class='alert alert-success fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
					Se ha modificado correctamente
				</div>
			");
		}else{
			echo ("
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					No se ha podido modificar
				</div>
			");
		}

	}


	if(isset($_POST['desplegable'])){

		$cod_autor = $_POST['desplegable'];

		$consulta  = "SELECT * FROM autores WHERE cod_autor='$cod_autor';";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
		<div class='container'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Modificar datos autor</h4>
					</div>
					<div class='modal-body'>
						<form name='modificaAutor' action='modificarAutores.php' method='post'>
							<div class='form-group'>
								<div class='input-group'>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo ("
									<input type='hidden' name='cod_autor' value='".$dato['cod_autor']."'>
									<input type='text' id='nombre' class='form-control' name='nombre' value='".$dato['nombre']."' required placeholder='Nombre'>
									<label for='nombre' class='input-group-addon glyphicon glyphicon-font'></label>
								</div>
							</div>
							<div class='form-group'>
								<div class='input-group'>
									<input type='text' id='apellidos' class='form-control' name='apellidos' value='".$dato['apellidos']."' required placeholder='Apellidos' />
									<label for='apellidos' class='input-group-addon glyphicon glyphicon-font'></label>
								</div>
							</div>
			");
		}
			echo ("
							<button class='form-control btn btn-warning'>Modificar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
			");
	}else{
		$consulta  = "SELECT * FROM autores ORDER BY nombre, apellidos;";
		$resultado = mysqli_query($conexion, $consulta);
		
		echo ("
		<div class='container'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Modificar autor</h4>
					</div>
					<div class='modal-body'>
						<form action='modificarAutores.php' method='post' onsubmit='return seleccionado();'>
							<div class='form-group'>
								<select id='selec' name='desplegable'>
									<option value='vacio' selected>Selecciona un autor</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo ("
										<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>
			");
		}

		echo ("
								</select>
							</div>
							<button class='form-control btn btn-primary'/>Modificar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		");
	}

?>