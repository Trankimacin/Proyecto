<!DOCTYPE html>
<html lang="en">
<head>
  <title>Menu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/estilos.css">
<script src="../js/estilos.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDropdownMenuLink">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarDropdownMenuLink">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown">
          Revistas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="altaRevista.php">Alta Revista</a>
          <a class="dropdown-item" href="modificarRevista.php">Modificar Revistar</a>
          <a class="dropdown-item" href="bajaRevista.php">Elimiar Revista</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" >
          Articulos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="altaArticulos.php">Alta Articulo</a>
          <a class="dropdown-item" href="modificarArticulos.php">Modificar Articulo</a>
          <a class="dropdown-item" href="bajaArticulos.php">Elimiar Articulo</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" >
          Autores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="altaAutor.php">Alta Autor</a>
          <a class="dropdown-item" href="modificarAutor.php">Modificar Autor</a>
          <a class="dropdown-item" href="bajaAutor.php">Elimiar Autor</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="altaUsuario.php">Alta Usuario</a>
          <a class="dropdown-item" href="modificarUsuario.php">Modificar Usuario</a>
          <a class="dropdown-item" href="bajaUsuario.php">Eliminar Usuario</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="salir.php">Desconectarse</a>
      </li>
    </ul>
  </div>
</nav>