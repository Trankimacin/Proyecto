<?php

	require_once("conexion.php");

	$consulta = "SELECT * FROM articulos ORDER BY cod_articulo DESC LIMIT 5;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("
		<div class='enlaces'>
		<h2>Últimos articulos añadidos</h2>
			<ul>
	");

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
			<li><a href='articulo.php?c=".$dato['cod_articulo']."'>".$dato['titulo']."</a></li>
		");
	}

	echo ("
			</ul>
		</div>
	");

?>