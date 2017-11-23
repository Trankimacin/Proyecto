<?php

	include_once("menu.php");

	if(isset($_GET['re'])){

	$cod_revista = $_GET['re'];

	$consulta = "SELECT * FROM articulos, imagenes WHERE articulos.cod_revista=$cod_revista AND imagenes.cod_imagen=articulos.cod_imagen;";

	$resultado = mysqli_query($conexion, $consulta);

	echo ("
		<div class='container'>
			<div class='row'>
				<div class='col-md-9'>
					<h2 class='text-center text-danger'>Listado de articulos</h2>

	");
		while($dato=mysqli_fetch_array($resultado)){
			echo ("
						<div class='col-md-4'>
							<div class='thumbnail'>
						        <a href='articulo.php?ar=".$dato['cod_articulo']."'><img src='media/img/portadas/".$dato['ruta']."' alt='Imagen'></a>
						        <div class='caption text-center'>
						          <h3>Título: ".$dato['titulo']."</h3>
						        </div>
						      </div>
						    </div>
			");
		}
			echo ("
						</div>
			");

	}else if(isset($_GET['ar'])){

		$cod_articulo = $_GET['ar'];

		$consulta = "SELECT * FROM articulos, autores, imagenes WHERE articulos.cod_articulo=$cod_articulo AND imagenes.cod_imagen=articulos.cod_imagen AND autores.cod_autor=articulos.cod_autor;";

		$resultado = mysqli_query($conexion, $consulta);

		echo ("
			<div class='container'>
				<div class='row'>
					<div class='col-md-9'>
						<h2 class='text-center text-danger'>Artículo</h2>
		");
		while($dato=mysqli_fetch_array($resultado)){
			echo ("
						<div class='col-md-3'>
							<img src='media/img/articulos/".$dato['ruta']."' alta='Articulo'>
						</div>
						<div class='col-md-6'>
							<h2 class='text-center text-danger'>".$dato['titulo']."</h2>
						</div>
						<div class='col-md-12'>
							<p>".$dato['entradilla']."</p>
						</div>
						<div class='col-md-12'>
							<p>".$dato['texto']."</p>
						</div>
						<div class='col-md-12'>
							<h4 class='text-center text-danger'>".$dato['nombre']." ".$dato['apellidos']."</h4>
						</div>
					</div>
			");

		}
	}

	include_once("lateral.php");

	include("footer.php");
?>