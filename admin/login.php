<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<?php

	if(isset($_GET['m'])){
		if($_GET['m']=='w'){
			echo ("<h2>Introduce un usuario y/o contraseña valida</h2>");
		}else if($_GET['m']=='e'){
			echo ("<h2>La sesión ha finalizado</h2>");
		}
	}

	?>

	<form action="validacion.php" method="post">
	<label>Usuario:</label>
	<input type="text" name="usuario_txt" placeholder="Usuario" required />
	<label>Password:</label>
	<input type="password" name="pass_txt" placeholder="Contraseña" required />
	<input type="submit" value="Enviar" name="enviar_btn" />
	<input type="reset" value="Borrar" />
	</form>

</body>
</html>