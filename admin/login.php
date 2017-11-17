<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/estilos.css">
	<title></title>
</head>
<body>
	<?php

	if(isset($_GET['m'])){
		if($_GET['m']=='w'){
			echo ("<div class='error-msg'>
					<i class='fa fa-times-circle'></i>
					Usuario y/o contraseña no valida
					</div>");
		}else if($_GET['m']=='e'){
			echo ("<div class='warning-msg'>
					<i class='fa fa-warning'></i>
					La sesión ha caducado
					</div>");
		}
	}

	?>


<form action="validacion.php" method="post">
  <div class="container">
    <label>Usuario</label>
    <input type="text" placeholder="Enter Username" name="usuario_txt" required>

    <label>Password</label>
    <input type="password" placeholder="Enter Password" name="pass_txt" required>
        
    <input type="submit" name="enviar_btn" value="Login">
  </div>
</form>

</body>
</html>