<?php

	include_once('menu.php');

	$consulta = "SELECT * FROM revistas WHERE publicada=1;";

	$resultado = mysqli_query($conexion, $consulta);

	$tuplas = mysqli_num_rows($resultado);

	if($tuplas==0){
		echo ("
			<div class='alert alert-danger fade in'>
				<a href='' class='close' data-dismiss='alert'>&times;</a>
				<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
				No hay ninguna revista en la base de datos
			</div>
		");
	}else{

		echo ("
			<div class='container'>
				<div class='row'>
				<div class='container col-md-9'>
		");
		while($dato=mysqli_fetch_array($resultado)){
			echo ("
				    <div class='col-md-4'>
				      <div class='thumbnail'>
				        <a href='articulo.php?r=".$dato['cod_revista']."'><img src='media/img/portadas/".$dato['portada']."' alt='Imagen'></a>
				        <div class='caption text-center'>
				          <h3>Número: ".$dato['numero']."</h3>
				          <p>Fecha: ".$dato['fecha']."</p>
				        </div>
				      </div>
				    </div>
			");
		}
		echo ("
				</div>
		");
	}

	include_once("lateral.php");

	include_once("footer.php");
?>