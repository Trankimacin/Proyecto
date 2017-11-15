<?php

	//require_once("sesion.php");
	//require_once("caducidad.php");
	include_once("menu.php");
	require_once("conexion.php");

?>

	<h2>Añadir un nuevo articulo</h2>

	<form action="altaArticulos.php" method="post" enctype="multipart/form-data">
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
				<option value='Ninguno'>Sin autor</option>
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
		<p><input type="submit" value="Añadir">
			<input type="reset" value="Borrar"></p>
	</form>