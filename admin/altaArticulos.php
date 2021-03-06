<?php

	//require_once("sesion.php");
	require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

	if(!empty($_FILES['archivo']['name'])){

		$info = getimagesize($_FILES['archivo']['tmp_name']);

		if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG) && $_FILES['archivo']['size']<=1048576) {
  			echo ("<h2>Solo se admiten lo siguientes archivos: .gif / .jpeg / .png");
		}else{
			$archivo = $_FILES['archivo']['tmp_name'];
			$destino = '../media/img/articulos/' .$_FILES['archivo']['name'];
			$nombre  = $_FILES['archivo']['name'];

			if(move_uploaded_file($archivo, $destino)){
				$consulta = "INSERT INTO imagenes(ruta) VALUES ('$nombre');";
				mysqli_query($conexion, $consulta);
				$cod_imagen=mysqli_insert_id($conexion);
			}

			if(isset($_POST['nombre'])){

				$nombre2   = $_POST['nombre'];
				$apellidos = $_POST['apellidos'];

				$consulta = "INSERT INTO autores(nombre, apellidos) VALUES ('$nombre2', '$apellidos');";

				mysqli_query($conexion, $consulta);

				$cod_autor = mysqli_insert_id($conexion);

			}else{

				$cod_autor = $_POST['autor'];

			}
			
			if(isset($_POST['revista'])){

				$titulo      = $_POST['titulo'];
				$entradilla  = $_POST['entradilla'];
				$texto       = $_POST['texto'];
				$cod_revista = $_POST['revista'];

				$consulta = "INSERT INTO articulos(titulo, entradilla, texto, cod_revista, cod_autor, cod_imagen) VALUES ('$titulo', '$entradilla', '$texto', '$cod_revista', '$cod_autor', '$cod_imagen');";

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
		}
	}

?>
<div class='container'>

	<form class="form-horizontal" name="revista" action="altaArticulos.php" method="post" enctype="multipart/form-data" onsubmit="return subido();">
		<fieldset>
			<legend>A&ntilde;adir nuevo articulo
				<a href='#' data-trigger='focus' data-toggle='titulo' data-content='Primero debe tener creada una revista' class='glyphicon glyphicon-cog'></a>
			</legend>

		<!-- Titutlo -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="titulo">T&iacute;tulo</label>
			<div class="col-md-4">
				<input type="text" id="titulo" name="titulo" class="form-control input-md" required>
			</div>
		</div>

		<!-- Entradilla -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="entradilla">Entradilla</label>
			<div class="col-md-4">
				<textarea maxlength="250" class="form-control" id="entradilla" name="entradilla" required></textarea>
				<span class='help-block'>M&aacute;ximo 250 caracteres</span>
			</div>
		</div>

		<!-- Texto -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="texto">Texto</label>
			<div class="col-md-4">
				<textarea class="form-control" id="texto" name="texto" required></textarea>
			</div>
		</div>

		<!-- Revista -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="revista">Revista</label>
			<div class="col-md-4">
				<select class="form-control" name="revista" id="revista">
<?php
	$consulta = "SELECT cod_revista, numero, fecha FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
			<option value='".$dato['cod_revista']."'>N&uacute;mero: ".$dato['numero']." Fecha: ".$dato['fecha']."</option>
		");
	}
?>
				</select>
			</div>
		</div>

		<!-- Autor -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="autor">Autor</label>
			<div class="col-md-4">
				<select class="form-control" name="autor" id="autor" onChange="checkOption(this)">
				<option value='vacio'>Sin autor</option>
<?php
	$consulta = "SELECT * FROM autores ORDER BY nombre, apellidos;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo("
			<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>
		");
	}
?>
				</select>
			</div>
		</div>

		<!-- Portada -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="archivo">Imagen</label>
			<div class="col-md-4">
				<input class="input-file" type="file" id="archivo" name="archivo">
			</div>
		</div>

		<div class="container">
		    <div class="row medio">
		        <h4>Nuevo Autor <a href='#' data-trigger='focus' data-toggle='nuevo' data-content='Desde aqu&iacute; crearemos un nuevo Autor' class='glyphicon glyphicon-cog'></a></h4>
		    </div>
		</div>
			<!-- Nombre Nuevo Autor -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="nuevoNombre">Nombre</label>
			<div class="col-md-4">
				<input class="form-control input-md" type="text" name="nombre" id="nuevoNombre">
			</div>
		</div>

			<!-- Apellidos Nuevo Autor -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="apellidosAutor">Apellidos</label>
			<div class="col-md-4">
				<input class="form-control input-md" type="text" name="apellidos" id="apellidosAutor">
			</div>
		</div>
		
			<!-- Botones -->
		<div class="form-group">
			<label class="col-md-4 control-label"></label>
			<div class="col-md-8">
				<button class="btn btn-success">A&ntilde;adir</button>
			</div>
		</div>
	</fieldset>
</form>
</div>
<script>
$(document).ready(function(){
    $('[data-toggle="titulo"]').popover();   
    $('[data-toggle="nuevo"]').popover();
});
</script>