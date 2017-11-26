<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");

	if(isset($_POST['nombre'])){

		require_once("conexion.php");

		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];

		$consulta = "INSERT INTO autores(nombre, apellidos) VALUES ('$nombre', '$apellidos');";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)==0){
			echo ("
			    <div class='alert alert-success fade in'>
			      <a href='' class='close' data-dismiss='alert'>&times;</a>
			      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
			      Se ha a&ntilde;adido correctamente
			  	</div>
			");
		}else{
			echo ("
			  <div class='alert alert-danger fade in'>
			      <a href='' class='close' data-dismiss='alert'>&times;</a>
			      <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
			      No se ha podido a&ntilde;adir
			  </div>
			");
		}
	}

?>
<div class='container'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">A&ntilde;adir un autor</h4>
			</div><!-- Termina la cabecera -->
			<div class="modal-body">
				<form action="altaAutores.php" method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre"/>
							<label for="nombre" class="input-group-addon glyphicon glyphicon-font"></label>
						</div>
					</div><!-- Termina el DIV de usuario-->
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos"/>
							<label for="apellidos" class="input-group-addon glyphicon glyphicon-font"></label>
						</div>
					</div>

					<button class="form-control btn btn-success">A&ntilde;adir</button>
				</form>
			</div><!--Termina el body-->
		</div><!--Termina el modal-content-->
	</div><!--Termina el div para el formulario-->
</div>