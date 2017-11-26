<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	require_once("conexion.php");
	include_once("menu.php");

	if(isset($_POST['articulo'])){

		$cod_articulo = $_POST['articulo'];
		$titulo       = $_POST['titulo'];
		$entradilla   = $_POST['entradilla'];
		$texto        = $_POST['texto'];
		$revista      = $_POST['revista'];
		$autor        = $_POST['autor'];

		if($titulo!=''){
			$consulta = "UPDATE articulos SET titulo='$titulo' WHERE cod_articulo='$cod_articulo';";
			mysqli_query($conexion, $consulta);
		}

		if($entradilla!=''){
			$consulta = "UPDATE articulos SET entradilla='$entradilla' WHERE cod_articulo='$cod_articulo';";
			mysqli_query($conexion, $consulta);
		}

		if($texto!=''){
			$consulta = "UPDATE articulos SET texto='$texto' WHERE cod_articulo='$cod_articulo';";
			mysqli_query($conexion, $consulta);			
		}

		if($revista!='vacio'){
			$consulta = "UPDATE articulos SET cod_revista='$revista' WHERE cod_articulo='$cod_articulo';";
			mysqli_query($conexion, $consulta);			
		}

		if($autor!='vacio'){
			$consulta = "UPDATE articulos SET cod_autor='$autor' WHERE cod_articulo='$cod_articulo';";
			mysqli_query($conexion, $consulta);			
		}

		if(!empty($_FILES['archivo']['name'])){

			$info = getimagesize($_FILES['archivo']['tmp_name']);

			if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG) && $_FILES['archivo']['size']<=1048576) {
	  			echo ("<h2>Solo se admiten lo siguientes archivos: .gif / .jpeg / .png");
			}else{
				$archivo = $_FILES['archivo']['tmp_name'];
				$destino = '../media/img/articulos/' .$_FILES['archivo']['name'];
				$nombre  = $_FILES['archivo']['name'];

				if(move_uploaded_file($archivo, $destino)){
					$consulta = "UPDATE articulos, imagenes SET ruta='$nombre' WHERE cod_articulo='$cod_articulo' AND articulos.cod_imagen=imagenes.cod_imagen;";
					mysqli_query($conexion, $consulta);
				}
			}
		}

		if(mysqli_errno($conexion)==0){
			echo ("
			    <div class='alert alert-success fade in'>
			      	<a href='' class='close' data-dismiss='alert'>&times;</a>
			      	<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
			    	Articulo modificado correctamente
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

		$cod_articulo = $_POST['desplegable'];

		echo ("	
		</div>
			<form name='formulario' class='form-horizontal' action='modificarArticulos.php' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Modificar Articulo
				<a href='#' data-trigger='focus' data-toggle='popover' class='glyphicon glyphicon-cog'></a>
				</legend>
					<input type='hidden' name='articulo' value='$cod_articulo'>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='titulo'>Titulo</label>
					<div class='col-md-4'>
						<input id='titulo' name='titulo' type='text' class='form-control input-md'>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='entradilla'>Entradilla</label>
					<div class='col-md-4'>
					<textarea class='form-control' id='entradilla' name='entradilla' maxlength='250'></textarea>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='texto'>Texto</label>
					<div class='col-md-4'>
					<textarea class='form-control' id='texto' name='texto'></textarea>
					</div>
				</div>
				<div class='form-group'>
					<label for='revista' class='col-md-4 control-label'>Revista</label>
					<div class='col-md-4'>
						<select class='form-control' id='revista' name='revista'>
							<option value='vacio'>Seleciona una revista</option>
		");

	$consulta = "SELECT cod_revista, numero, fecha FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
							<option value='".$dato['cod_revista']."'>N&uacute;mero: ".$dato['numero']." Fecha: ".$dato['fecha']."</option>
		");
	}
		echo ("
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label for='autor' class='col-md-4 control-label'>Autor</label>
					<div class='col-md-4'>
						<select class='control-form' name='autor' id='autor'>
							<option value='vacio'>Selecciona un autor</option>
			");
		
	mysqli_free_result($consulta);

	$consulta = "SELECT * FROM autores ORDER BY nombre, apellidos;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo("
							<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>
		");
	}
		echo("
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label' for='imagen'>Imagen</label>
					<div class='col-md-4'>
						<input type='file' id='imagen' name='archivo' class='input-file'>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-4 control-label'></label>
					<div class='col-md-8'>
						<button class='btn btn-success'>Modificar</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
		");

	}else{

		$consulta = "SELECT * FROM articulos ORDER BY titulo;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
		<div class='container'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Modificar Articulo</h4>
					</div>
					<div class='modal-body'>
						<form action='modificarArticulos.php' method='post' onsubmit='return seleccionado();'>
							<div class='form-group'>
								<select id='selec' name='desplegable'>
									<option value='vacio' selected>Selecciona un articulo</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
				echo ("
					<option value='".$dato['cod_articulo']."'>".$dato['titulo']."</option>
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
<script>
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover({
    html:true,
    content:function(){
    return ("Cambia solo los campos que quieras");
    },
    });   
});
</script>