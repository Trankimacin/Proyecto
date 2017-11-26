<?php

	include_once('menu.php');

	echo ("
<!-- Empieza el contenido de la página -->
	");

	if(isset($_GET['u'])){

		$cod_revista = $_GET['u'];

		$consulta = "SELECT * FROM revistas WHERE cod_revista=$cod_revista;";

		$ultimo = mysqli_query($conexion, $consulta);

		$tuplas = mysqli_num_rows($ultimo);

		if($tuplas==0){
			echo("
				<div class='container'>
				<div class='col-md-9'>
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					No hay ninguna revista para mostrar
				</div>
				</div>
			");

		}else{

				echo ("
					<div class='container'>
						<div class='row'>
							<div class='col-md-9'>
								<h2 class='text-center text-danger'>&Uacute;ltima revista</h2>
				");

			$dato=mysqli_fetch_array($ultimo);

					echo ("
							    <div class='col-md-4'>
							      <div class='thumbnail'>
							        <a href='articulo.php?re=$dato[cod_revista]'><img src='media/img/portadas/$dato[portada]' alt='Imagen'></a>
							        <div class='caption text-center'>
							          <h3>N&uacute;mero: $dato[numero]</h3>
							          <p>Fecha: $dato[fecha]</p>
							        </div>
							      </div>
							    </div>
							</div>
		<!-- Termina el contenido de la página -->
					");

			}

	}else if(isset($_GET['a'])){

		$cod_revista = $_GET['a'];

		if($cod_revista==''){

			echo("
				<div class='container'>
				<div class='col-md-9'>
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					No hay revistas para mostrar
				</div>
				</div>
			");

		}else{

			$consulta = "SELECT * FROM revistas WHERE cod_revista != (SELECT MAX(cod_revista) FROM revistas WHERE publicada=1) AND publicada=1 ORDER BY cod_revista DESC";

			$resultado3 = mysqli_query($conexion, $consulta);

					echo ("
						<div class='container'>
							<div class='row'>
								<div class='col-md-9'>
									<h2 class='text-center text-danger'>&Uacute;ltimas revistas</h2>
					");

				while($dato=mysqli_fetch_array($resultado3)){
						echo ("
								    <div class='col-md-4'>
								      <div class='thumbnail'>
								        <a href='articulo.php?re=$dato[cod_revista]'><img src='media/img/portadas/$dato[portada]' alt='Imagen'></a>
								        <div class='caption text-center'>
								          <h3>N&uacute;mero: $dato[numero]</h3>
								          <p>Fecha: $dato[fecha]</p>
								        </div>
								      </div>
								    </div>
							");
				}
							echo("</div>
			<!-- Termina el contenido de la página -->
						");
		}

	}else{

		$consulta = "SELECT * FROM revistas WHERE publicada=1 ORDER BY cod_revista DESC;";

		$resultado = mysqli_query($conexion, $consulta);

		$tuplas = mysqli_num_rows($resultado);

		if($tuplas==0){
			echo ("
				<div class='container'>
				<div class='col-md-9'>
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					No hay ninguna revista para mostrar
				</div>
				</div>
			");
		}else{

			echo ("
				<div class='container'>
					<div class='row'>
						<div class='col-md-9'>
							<h2 class='text-center text-danger'>Listado de revistas</h2>
			");
			while($dato=mysqli_fetch_array($resultado)){
				echo ("
						    <div class='col-md-4'>
						      <div class='thumbnail'>
						        <a href='articulo.php?re=".$dato['cod_revista']."'><img src='media/img/portadas/".$dato['portada']."' alt='Imagen'></a>
						        <div class='caption text-center'>
						          <h3>N&uacute;mero: ".$dato['numero']."</h3>
						          <p>Fecha: ".$dato['fecha']."</p>
						        </div>
						      </div>
						    </div>
				");
			}
			echo ("
						</div>
	<!-- Termina el contenido de la página -->
			");
		}
	}

	include_once("lateral.php");

	include_once("footer.php");
?>

<!-- Termina el contenido de la página -->