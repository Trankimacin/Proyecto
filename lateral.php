<!-- Empieza el Aside -->

<?php

	require_once("conexion.php");

	$consulta = "SELECT * FROM articulos, revistas WHERE revistas.publicada=1 AND revistas.cod_revista=articulos.cod_revista ORDER BY cod_articulo DESC LIMIT 10;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("
			<div class='col-md-3'>
			<h4 class='text-center text-danger'>&Uacute;ltimos articulos a&ntilde;adidos</h4>
			<ul class='list-group'>
	");

	while($dato=mysqli_fetch_array($resultado)){
		echo ("
				<li class='list-group-item'><a href='articulo.php?ar=".$dato['cod_articulo']."'>".$dato['titulo']."</a></li>
		");
	}

	echo ("
			</ul>
			</div>
		</div>
		</div>
	");

?>

<!-- Termina el Aside -->