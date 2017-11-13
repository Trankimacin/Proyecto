<?php

if (($_SESSION['hora']+1200)<time()){

	session_destroy();

	header("Location:login.php?mensaje=caducada");
}
?>