<?php

	include_once("menu.php");

	if(isset($_POST['buscar'])){
		$autor = $_POST['buscar'];

		$consulta = "SELECT * FROM autores WHERE nombre LIKE '%$autor%' OR apellidos LIKE '%$autor%';";

		$resultado = mysqli_query($conexion, $consulta);

		if(mysqli_errno($conexion)!=0){
			echo("
				<div class='alert alert-danger fade in'>
					<a href='' class='close' data-dismiss='alert'>&times;</a>
					<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
					Error inesperado
				</div>
			");
		}else{
			$tuplas = mysqli_num_rows($resultado);

			if($tuplas==0){
				echo("
					<div class='alert alert-danger fade in'>
						<a href='' class='close' data-dismiss='alert'>&times;</a>
						<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
						No hay ningún autor llamado así
					</div>
				");
			}else{
				$fila = mysqli_fetch_assoc($resultado);

				$cod_autor = $fila['cod_autor'];
				
				$consulta = "SELECT * FROM articulos WHERE cod_autor='$cod_autor';";

				$resultado = mysqli_query($conexion, $consulta);

				while($dato=mysqli_fetch_array($resultado)){
					echo ($dato['titulo']);
				}

			}
		}
	}

?>