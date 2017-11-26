<?php

session_start();
	if(!($_SESSION["logueado"])){
		header("Location:salir.php");
	}else{

		if (($_SESSION['hora']+1200)<time()){

			session_destroy();

			header("Location:index.php?m=e");
		}
	}
?>