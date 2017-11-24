<?php

	include_once("menu.php");

?>

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="col-md-9 col-md-offset-2">
					<h2 class="text-center text-danger">Mapa web</h2>
						<ul class="lista">
							<li><a href="index.php">Revistas</a></li>
<?php

	$consulta = "SELECT * FROM revistas WHERE publicada=1 LIMIT 20;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo("
								<ul>
									<li><a href='articulo.php?re=$dato[cod_revista]'>Revista Coches - Número: $dato[numero] Fecha: $dato[fecha]</a></li>
								</ul>
		");
	}
?>
<?php

	$conusulta = "SELECT * FROM revistas WHERE publicada=1 ORDER BY cod_revista DESC;";

	$resultado = mysqli_query($conexion, $consulta);

	$dato = mysqli_fetch_array($resultado);
				echo ("		<li><a href='index.php?u=$dato[cod_revista]'>Última revista</a></li>");

?>
<?php

  $consulta = "SELECT * FROM revistas WHERE cod_revista != (SELECT MAX(cod_revista) FROM revistas WHERE publicada=1) AND publicada=1 ORDER BY cod_revista DESC;";
  $resultado = mysqli_query($conexion, $consulta);
  $dato = mysqli_fetch_array($resultado);
  				echo ("		<li><a href='index.php?a=$dato[cod_revista]'>Revistas anteriores</a></li>");

?>
							<li><a>Articulos</a></li>
<?php

	$consulta = "SELECT * FROM revistas, articulos WHERE revistas.publicada=1 AND revistas.cod_revista=articulos.cod_revista LIMIT 30;";

	$resultado = mysqli_query($conexion, $consulta);

	while($dato=mysqli_fetch_array($resultado)){
		echo("
								<ul>
									<li><a href='articulo.php?ar=$dato[cod_articulo]'>Articulo $dato[titulo]</a></li>
								</ul>
		");
	}
?>
							<li><a href="contacto.php">Contacto</a></li>
							<li><a href="privacidad.php">Politica de privacidad</a></li>
							<li><a href="mapa.php">Mapa de sitio</a></li>
						</ul>
				</div>
			</div>

<?php

	include_once("lateral.php");

	include_once("footer.php");

?>