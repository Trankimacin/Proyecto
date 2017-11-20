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