<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
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
			}
		}
	}

	if(isset($_POST['revista'])){

		$titulo      = $_POST['titulo'];
		$entradilla  = $_POST['entradilla'];
		$texto       = $_POST['texto'];
		$cod_revista = $_POST['revista'];

		$consulta = "INSERT INTO articulos(titulo, entradilla, texto, cod_revista) VALUES ('$titulo', '$entradilla', '$texto', '$cod_revista');";

		mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)!=0){
			echo ("<h2>No se pudo hacer inserción</h2>");
		}else{
			echo ("<h2>Todo bien</h2>");
		}

		if(isset($_POST['autor'])){

			$cod_autor = $_POST['autor'];

			if($cod_autor!='vacio'){

				$consulta = "UPDATE articulos SET cod_autor='$cod_autor' WHERE titulo='$titulo';";

				mysqli_query($conexion, $consulta);

				if(mysqli_errno($conexion)!=0){
					echo ("<h2>No se pudo hacer la inserción</h2>");
				}
			}
		}

		if(!empty($_FILES['archivo']['name'])){

			$consulta = "SELECT cod_imagen FROM imagenes WHERE ruta='$nombre';";

			$resultado = mysqli_query($conexion, $consulta);

			$resultado = mysqli_fetch_assoc($resultado);

			$cod_imagen = $resultado['cod_imagen'];

			echo ($cod_imagen);

			$update = "UPDATE articulos SET cod_imagen='$cod_imagen' WHERE titulo='$titulo';";

			mysqli_query($conexion, $update);
		}

	}

?>

	<h2>Añadir un nuevo articulo</h2>

	<form name="altaAutor" action="altaArticulos.php" method="post" enctype="multipart/form-data">
		<p><input type="text" name="titulo" placeholder="Título" required></p>
		<p><textarea maxlength="250" cols="40" rows="6" name="entradilla" placeholder="Entradilla"  required></textarea></p>
		<p><textarea cols="40" rows="6" name="texto" placeholder="Texto articulo" required></textarea></p>
		<p><label>Revista:</label>
			<select name="revista">
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
		<p><label>Autor:</label>
			<select name="autor">
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
			</select></p>
		");
?>
		<p><label>Imagen:</label>
		<input type="file" name="archivo" style="color: transparent;"></p>
		<p><input type="button" value="Añadir" onclick="return selec();">
			<input type="reset" value="Borrar"></p>
	</form>