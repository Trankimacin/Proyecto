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
			echo ("<div class='success-msg'>
					<i class='fa fa-check'></i>
					Se ha modificado correctamente
					</div>
			");
		}else{
			echo ("<div class='error-msg'>
					<i class='fa fa-times-circle'></i>
					No se pudo modificar
					</div>");
		}
	}

	if(isset($_POST['desplegable'])){

		$cod_articulo = $_POST['desplegable'];

		echo ("
			<div class='wrapper'>

			<h2 id='account'>Modificar articulo
				<div class='tooltip'>
					<i class='fa fa-question'></i>
						<div class='tooltiptext'>Rellena solo los campos que quiera cambiar</div>
				</div>
			</h2>
		");

		echo ("<form name='modificar' action='modificarArticulos.php' method='post' enctype='multipart/form-data'>
			<div class='info'>
			<input type='hidden' name='articulo' value='$cod_articulo'>
		");
?>
		<label for='titulo'>Título</label>
		<input type="text" id="titulo" name="titulo">
		<label for='entradilla'>Entradilla
			<div class='tooltip'>
				<i class='fa fa-question'></i>
					<span class='tooltiptext'>Máximo 250 carácteres</span>
			</div>
		</label>
		<textarea maxlength="250" id='entradilla' name="entradilla"></textarea>
		<label for='texto'>Texto</label>
		<textarea id='texto' name="texto"></textarea>
		<label for="revista">Revista</label>
			<select name="revista">
				<option value="vacio" id="revista">Seleciona una revista</option>
<?php
	$consulta = "SELECT cod_revista, numero, fecha FROM revistas ORDER BY numero;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
			<option value='".$dato['cod_revista']."'>Número: ".$dato['numero']." Fecha: ".$dato['fecha']."</option>
		");
	}
		echo ("
			</select></p>
		");
?>
		<label for="autor">Autor</label>
			<select name="autor" id="autor">
				<option value='vacio'>Selecciona un autor</option>
<?php
	$consulta = "SELECT * FROM autores ORDER BY nombre, apellidos;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo("
			<option value='".$dato['cod_autor']."'>".$dato['nombre']." ".$dato['apellidos']."</option>
		");
	}
		echo("
			</select></p>
		");
?>
		<label for="imagen">Imagen</label>
		<input type="file" id="imagen" name="archivo">
		<div class="buttons">
			<input type="submit" value="Modificar"">
			<input type="reset" value="Borrar">
		</div>
	</div>
</div>
	</form>

<?php
	}else{

		$consulta = "SELECT * FROM articulos ORDER BY titulo;";
		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<h2>Selecciona un articulo para modificar</h2>
			<form name='modifica' method='post' action='modificarArticulos.php'>
				<select name='desplegable'>
					<option value='vacio' selected>Selecciona un articulo</option>
		");

		while($dato=mysqli_fetch_array($resultado)){
			echo("
					<option value='".$dato['cod_articulo']."'>".$dato['titulo']."</option>
			");
		}

		echo("
				</select>
				<input type='button' value='Modificar' onclick='return seleccionado();'>
			</form>
		");
	}

?>