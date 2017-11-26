<!DOCTYPE html>
<html lang='es'>
<head>
  <title>Revista Coches</title>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>

<!-- Humans -->
<link type="text/plain" rel="author" href="humans.txt" />
<!-- FavIcon -->
<link rel='icon' type='img/png' href='favicon.ico'>
<!-- CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='css/estilos.css'>
<!-- JQuery -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!-- JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='js/estilos.js'></script>

<style>
.form-group {
  width: initial;
}
</style>

<?php

  require_once('conexion.php');

  $consulta = "SELECT cod_revista FROM revistas WHERE publicada=1 ORDER BY cod_revista DESC LIMIT 1;";
  $resultado = mysqli_query($conexion, $consulta);
  $dato2=mysqli_fetch_array($resultado);

  mysqli_free_result($resultado);

  $consulta = "SELECT * FROM revistas WHERE cod_revista != (SELECT MAX(cod_revista) FROM revistas WHERE publicada=1) AND publicada=1 ORDER BY cod_revista DESC;";
  $resultado = mysqli_query($conexion, $consulta);
  $dato = mysqli_fetch_array($resultado);

echo ("
</head>


<!-- Empieza el menu de navegación -->

<nav class='navbar navbar-inverse'>
  	<div class='container-fluid'>
    	<div class='navbar-header'>
      	<button type='button' class='navbar-toggle pull-left' data-toggle='collapse' data-target='#myNavbar'>
        	<span class='icon-bar'></span>
        	<span class='icon-bar'></span>
        	<span class='icon-bar'></span>                        
      	</button>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
		<ul class='nav navbar-nav'>
			<li><a href='index.php'>Revistas</a></li>
		</ul>
		<ul class='nav navbar-nav'>
			<li><a href='index.php?u=$dato2[cod_revista]'>&Uacute;ltima Revista</a></li>
		</ul>
    <ul class='nav navbar-nav'>
      <li><a href='index.php?a=$dato[cod_revista]'>Revistas Anteriores</a></li>
    </ul>
    <ul class='nav navbar-nav'>
      <li><a href='contacto.php'>Contacto</a></li>
    </ul>
      	<ul class='nav navbar-nav navbar-right'>
        	<form class='navbar-form navbar-left' role='search' action='buscar.php' method='post' onsubmit='return comprobar();'>
		  		<div class='form-group'>
		    		<input type='text' name='buscar' id='buscar' class='form-control' placeholder='Buscar autor'>
		  		</div>
		  		<button type='submit' class='btn btn-danger'>Buscar</button>
			</form>
      	</ul>
    </div>
 	</div>
</nav>

<!-- Termina la barra de navegación -->

");

?>