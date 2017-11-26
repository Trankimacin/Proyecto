<?php

	include_once("menu.php");

	echo ("
		<div class='container'>
			<div class='row'>
				<div class='col-md-9'>
	");

	if(isset($_POST['buscar'])){

		$autor = $_POST['buscar'];

		$consulta = "SELECT * FROM autores WHERE nombre LIKE '%$autor%' OR apellidos LIKE '%$autor%';";

		$resultado = mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)!=0){
			echo("
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					Error inesperado
				</div>
				</div>
			");
		}else{
			$tuplas = mysqli_num_rows($resultado);

			if($tuplas==0){
				echo("
					<div class='alert alert-danger fade in'>
						<a href='' class='close' data-dismiss='alert'>&times;</a>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						Se han encontrado $tuplas resutados
					</div>
					</div>
				");
			}else{
				echo ("<h2 class='text-center text-danger'>Resultados de la búsqueda</h2>");
				$fila = mysqli_fetch_assoc($resultado);

				$cod_autor = $fila['cod_autor'];
				
				$consulta = "SELECT * FROM autores, articulos, imagenes WHERE autores.cod_autor='$cod_autor' AND articulos.cod_autor='$cod_autor' AND articulos.cod_imagen=imagenes.cod_imagen;";

				$resultado = mysqli_query($conexion, $consulta);

				while($dato=mysqli_fetch_array($resultado)){
					echo ("
						<div class='col-md-4'>
							<div class='thumbnail'>
								<a href='articulo.php?ar=".$dato['cod_articulo']."'><img src='media/img/articulos/".$dato['ruta']."' alt='Imagen'></a>
								<div class='caption text-center'>
						        	<h3>".$dato['titulo']."</h3>
						        	<p>Autor: ".$dato['nombre']." ".$dato['apellidos']."</p>
						        </div>
							</div>
						</div>
					");
				}

				echo ("</div>");

			}
		}
	}

	include_once("lateral.php");

	include_once("footer.php");

?>