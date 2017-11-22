<?php

	require_once("conexion.php");

	$consulta = "SELECT * FROM articulos ORDER BY cod_articulo DESC LIMIT 5;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("
			<div class='col-md-3'>
			<h4>Últimos articulos añadidos</h4>
			<ul class='list-group'>
	");

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
				<li class='list-group-item'><a href='articulo.php?c=".$dato['cod_articulo']."'>".$dato['titulo']."</a></li>
		");
	}

	echo ("
			</ul>
			</div>
		</div>
		</div>
	");

?>