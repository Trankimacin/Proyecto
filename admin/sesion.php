<?php

	session_start();
	if(!($_SESSION["logueado"])){
		header("Location:salir.php");
	}

?>