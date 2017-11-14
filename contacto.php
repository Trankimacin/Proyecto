<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="js/estilos.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>

	<div class="container">  
		<form id="contact" action="contacto.php" method="post">
			<h3>Formulario de contacto</h3>
			<fieldset>
				<input placeholder="Tu nombre" type="text" tabindex="1" required autofocus>
			</fieldset>
			<fieldset>
				<input placeholder="Tu email" type="email" tabindex="2" required>
			</fieldset>
			<fieldset>
				<input placeholder="Teléfono de contacto" type="tel" tabindex="3" required>
			</fieldset>
			<fieldset>
				<textarea placeholder="Escribe tu mensaje aquí...." tabindex="5" required></textarea>
			</fieldset>
			<fieldset>
				<button name="submit" type="submit" data-submit="...Sending">Enviar</button>
			</fieldset>
		</form>
	</div>

	<h3>Mapa</h3>

	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3038.5225295219266!2d-3.7160975858430683!3d40.39727374036454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4227c5d8a57ab7%3A0xe0ca2e9047817694!2sCalle+de+Antonio+L%C3%B3pez%2C+2-4%2C+28019+Madrid!5e0!3m2!1ses!2ses!4v1510671763663" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

</body>
</html>