<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- FavIcon -->
<link rel="icon" type="img/png" href="../favicon.ico">
<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilos.css">
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/estilos.js"></script>

</head>
<body>

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
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Revistas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="altaRevista.php">Alta Revista</a></li>
            <li><a href="modificarRevista.php">Modificar Revista</a></li>
            <li><a href="bajaRevista.php">Eliminar Revista</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Articulos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="altaArticulos.php">Alta Artiuclo</a></li>
            <li><a href="modificarArticulos.php">Modificar Articulo</a></li>
            <li><a href="bajaArticulos.php">Eliminar Articulo</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Autores <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="altaAutores.php">Alta Autor</a></li>
            <li><a href="modificarAutores.php">Modificar Autor</a></li>
            <li><a href="bajaAutores.php">Eliminar Autor</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="altaUsuario.php">Alta Usuario</a></li>
            <li><a href="modificarUsuario.php">Modificar Usuario</a></li>
            <li><a href="bajaUsuario.php">Eliminar Usuario</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Desconectarse</a></li>
      </ul>
    </div>
  </div>
</nav>