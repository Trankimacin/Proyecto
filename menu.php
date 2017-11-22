<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/estilos.css">
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/estilos.js"></script>
<!-- Conexion -->

<?php

  require_once("conexion.php");

?>

</head>

<nav class="navbar navbar-inverse">
  	<div class="container-fluid">
    	<div class="navbar-header">
      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>                        
      	</button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li><a href="revista.php">Revistas</a></li>
		</ul>
		<ul class="nav navbar-nav">
			<li><a href="articulo.php">Articulos</a></li>
		</ul>
    <ul class="nav navbar-nav">
      <li><a href="contacto.php">Contacto</a></li>
    </ul>
      	<ul class="nav navbar-nav navbar-right">
        	<form class="navbar-form navbar-left" role="search" action="buscar.php" method="post">
		  		<div class="form-group">
		    		<input type="text" name="buscar" class="form-control" placeholder="Buscar autor">
		  		</div>
		  		<button type="submit" class="btn btn-danger">Buscar</button>
			</form>
      	</ul>
    </div>
 	</div>
</nav>