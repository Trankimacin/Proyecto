<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="js/estilos.js"></script>
</head>
<body>

	<form action="contacto.php" method="post" onsubmit="return validacion();">

		<input type="tex" id="nombre" name="nombre" placeholder="Nombre" />
		<p id="validar"></p>
		<input type="tex" id="apellidos" name="apellidos" placeholder="Apellidos" />
		<p id="validar2"></p>
		<input type="text" id="email" name="email" placeholder="Correo electrónico" />
		<p id="validar3"></p>
		<textarea placeholder="Mensaje" id="mensaje" name="mensaje" ></textarea>
		<p id="validar4"></p>

		<input type="submit" value="Enviar" />
		<input type="reset" value="Borrar" />

	</form>

</body>
</html>