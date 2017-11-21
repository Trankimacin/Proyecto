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
			    <div class='col-sm-6 col-md-4'>
			      <div class='thumbnail'>
			        <a href=''><img src='...' alt='Imagen'></a>
			        <div class='caption'>
			          <h3>Titulo</h3>
			          <p>Fecha</p>
			        </div>
			      </div>
			    </div>
			    <div class='col-sm-6 col-md-4'>
			      <div class='thumbnail'>
			        <a href=''><img src='...' alt='Imagen'></a>
			        <div class='caption'>
			          <h3>Titulo</h3>
			          <p>Fecha</p>
			        </div>
			      </div>
			    </div>
			    <div class='col-sm-6 col-md-4'>
			      <div class='thumbnail'>
			        <a href=''><img src='...' alt='Imagen'></a>
			        <div class='caption'>
			          <h3>Titulo</h3>
			          <p>Fecha</p>
			        </div>
			      </div>
			    </div>
			    <div class='col-sm-6 col-md-4'>
			      <div class='thumbnail'>
			        <a href=''><img src='...' alt='Imagen'></a>
			        <div class='caption'>
			          <h3>Titulo</h3>
			          <p>Fecha</p>
			        </div>
			      </div>
			    </div>
			    <div class='col-sm-6 col-md-4'>
			      <div class='thumbnail'>
			        <a href=''><img src='...' alt='Imagen'></a>
			        <div class='caption'>
			          <h3>Titulo</h3>
			          <p>Fecha</p>
			        </div>
			      </div>
			    </div>
			    <div class='col-sm-6 col-md-4'>
			      <div class='thumbnail'>
			        <a href=''><img src='...' alt='Imagen'></a>
			        <div class='caption'>
			          <h3>Titulo</h3>
			          <p>Fecha</p>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
		");
	}

	include_once("footer.php");
?>