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
						        <a href='articulo.php?ar=".$dato['cod_articulo']."'><img src='media/img/articulos/".$dato['ruta']."' alt='Imagen'></a>
						        <div class='caption text-center'>
						          <h3>".$dato['titulo']."</h3>
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

		");
		while($dato=mysqli_fetch_array($resultado)){
			echo ("
						<div class='col-md-12'>
							<h1 class='text-center text-danger'>".$dato['titulo']."</h1>
						</div>
						<div class='col-md-12'>
							<img class='centrada' src='media/img/articulos/".$dato['ruta']."' data-toggle='modal' data-target='#grande' alt='Articulo'>
							<div class='modal fade' id='grande' role='dialog'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-body'>
											<img class='peque' src='media/img/articulos/$dato[ruta]'>
										</div>
										<div class='modal-footer'>
											<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
										</div>
									</div>
								</div>
							</div>							
						</div>
						<div class='col-md-12'>
							<p class='text-justify'><i>".$dato['entradilla']."</i></p>
						</div>
						<div class='col-md-12'>
							<p class='text-justify'>".$dato['texto']."</p>
						</div>
						<div class='col-md-12'>
							<h4 class='text-center text-danger'>Autor: ".$dato['nombre']." ".$dato['apellidos']."</h4>
						</div>
					</div>
			");

		}
	}

	include_once("lateral.php");

	include("footer.php");
?>