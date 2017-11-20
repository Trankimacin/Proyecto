<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	<?php

	if(isset($_GET['m'])){
		if($_GET['m']=='w'){
			echo ("
              <div class='alert alert-danger fade in'>
                  <a href='' class='close' data-dismiss='alert'>&times;</a>
                  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                  Usuario y/o Contraseña no valida
              </div>
        ");
		}else if($_GET['m']=='e'){
			echo ("
              <div class='alert alert-warning fade in'>
                  <a href='' class='close' data-dismiss='alert'>&times;</a>
                  <span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>
                  La sesión ha caducado por tiempo
              </div>
      ");
		}
	}

	?>



  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Log in</h4>
      </div> <!-- /.modal-header -->

      <div class="modal-body">
        <form role="form" method="post" action="validacion.php">
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="usuario_txt" class="form-control" id="uLogin" placeholder="Login">
              <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
            </div>
          </div> <!-- /.form-group -->

          <div class="form-group">
            <div class="input-group">
              <input type="password" name="pass_txt" class="form-control" id="uPassword" placeholder="Password">
              <label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
            </div> <!-- /.input-group -->

          </div> <!-- /.form-group -->
          <button name="enviar_btn" class="form-control btn btn-primary">Log-in</button>
        </form>

      </div> <!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

</body>
</html>