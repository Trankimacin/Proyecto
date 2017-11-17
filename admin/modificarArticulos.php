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
			echo ("<h2>Actualizado correctamente el articulo");
		}else{
			echo ("<h2>No se pudo actualizar el articulo</h2>");
		}
	}

	if(isset($_POST['desplegable'])){

		$cod_articulo = $_POST['desplegable'];

		echo ("
			<div class='bloque'>
			<h2>Introduce los datos que quieras cambiar</h2>
			<div class='tooltip'>
			<img src='../media/icon/info.png'>
			<span class='tooltiptext'>Los campos en blanco no los actualizará</span>
			</div>
			</div>	
		");

		echo ("<form name='modificar' action='modificarArticulos.php' method='post' enctype='multipart/form-data'>
			<input type='hidden' name='articulo' value='$cod_articulo'>
		");
?>
		<p><input type="text" name="titulo" placeholder="Título"></p>
		<p><textarea maxlength="250" cols="40" rows="6" name="entradilla" placeholder="Entradilla"></textarea></p>
		<p><textarea cols="40" rows="6" name="texto" placeholder="Texto articulo"></textarea></p>
		<p><label>Revista:</label>
			<select name="revista">
				<option value="vacio">Seleciona una revista</option>
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
		<p><label>Imagen:</label>
		<input type="file" name="archivo" style="color: transparent;"></p>
		<p><input type="submit" value="Modificar"">
			<input type="reset" value="Borrar"></p>
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