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
					echo ("<div class='success-msg'>
							<i class='fa fa-check'></i>
							Se ha añadido correctamente
							</div>
					");
				}else{
					echo ("<div class='error-msg'>
							<i class='fa fa-times-circle'></i>
							No se pudo añadir
							</div>");
				}

			}
		}
	}

?>

	<div class="wrapper">

	<h2 id="account">Añadir un nuevo articulo
		<div class="tooltip">
			<i class="fa fa-question"></i>
				<div class="tooltiptext">Primero deberás tener creada la revista</div>
		</div>
	</h2>

	<form name="revista" action="altaArticulos.php" method="post" enctype="multipart/form-data" onsubmit="return subido();">
		<div class="info">
		<!-- Titutlo -->
		<label for="titulo">Título</label>
		<input type="text" id="titulo" name="titulo" required>
		<!-- Entradilla -->
		<label for="entradilla">Entradilla
				<div class="tooltip">
		    		<i class="fa fa-question"></i>
		    			<span class="tooltiptext">Máximo 250 carácteres</span>
		    	</div>
		</label>
		<textarea maxlength="250" id="entradilla" name="entradilla" required></textarea>
		<!-- Texto -->
		<label for="texto">Texto</label>
		<textarea id="texto" name="texto" required></textarea>
		<!-- Revista -->
		<label for="revista">Revista</label>
			<select name="revista" id="revista">
<?php
	$consulta = "SELECT cod_revista, numero, fecha FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
			<option value='".$dato['cod_revista']."'>Número: ".$dato['numero']." Fecha: ".$dato['fecha']."</option>
		");
	}
		echo ("
			</select>
		");
?>
		<!-- Autor -->
		<label>Autor</label>
			<select name="autor" id="autor" onChange="checkOption(this)">
				<option value='vacio'>Sin autor</option>
<?php
	$consulta = "SELECT * FROM autores ORDER BY nombre, apellidos;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo("
			<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>
		");
	}
		echo("
			</select>
		");
?>
		<!-- Portada -->
		<label for="archivo">Imagen</label>
		<input type="file" id="archivo" name="archivo">
		<div class="attachements">
			<h3>Nuevo autor
				<div class="tooltip">
		    		<i class="fa fa-question"></i>
		    			<span class="tooltiptext">Si no hay seleccionado un autor, podrás añadirlo desde aquí</span>
		    	</div>
		    </h3>

			<!-- Nombre Nuevo Autor -->
			<label for="nuevoNombre">Nombre</label>
			<input type="text" name="nombre" id="nuevoNombre">
			<!-- Apellidos Nuevo Autor -->
			<label for="apellidosAutor">Apellidos</label>
			<input type="text" name="apellidos" id="apellidosAutor">
				<div class="buttons">
					<input type="submit" value="Añadir">
					<input type="reset" value="Borrar">
				</div>
		</div>
</div>		
	</form>