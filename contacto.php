<?php

	include_once("menu.php");

    if(isset($_POST['enviar'])){
        $destino = 'correo@hotmail.com';
        $asunto = "Mensaje enviado por: ".$_POST['nombre'];
        $remitente = $_POST['email'];
        $mensaje = 'Formulario de contacto de la revista';
        $mensaje .= '\nNombre: '.$_POST['nombre'];
        $mensaje .= '\nApellidos: '.$_POST['apellidos'];
        $mensaje .= '\nEmail: '.$_POST['email'];
        $mensaje .= '\nTeléfono: '.$_POST['telefono'];
        $mensaje .= '\nMensaje: '.$_POST['mensaje'];

        mail($destino,$asunto,$mensaje,"FROM: $remitente");
    }

?>
<!-- Formulario con mapa -->
<div class='container'>
    <div class='row'>
        <div class='col-md-6'>
            <div class='well well-sm'>
                <form class='form-horizontal' name='contacto' method='post' action="contacto.php">
                    <fieldset>
                        <legend class='text-center header'>Contacta con nosotros</legend>
                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='fname' name='nombre' type='text' placeholder='Nombre' class='form-control'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='lname' name='apellidos' type='text' placeholder='Apellidos' class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='email' name='email' type='text' placeholder='Dirección de correo' class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='phone' name='telefono' type='text' placeholder='Teléfono' class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <textarea class='form-control' id='message' name='mensaje' placeholder='Pon tu mensaje aquí.' rows='7'></textarea>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-12 text-center'>
                                <button type='submit' name="enviar" class='btn btn-primary btn-lg'>Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class='col-md-6'>
            <div>
                <div class='panel panel-default'>
                    <div class='text-center header'>Nuestra oficina</div>
                    <div class='panel-body text-center'>
                        <h4>Dirección</h4>
                        <div>
                        Prueba<br />
                        Madrid, España<br />
                        revista@revista.com<br />
                        </div>
                        <hr />
                        <div id='map1' class='map'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src='http://maps.google.com/maps/api/js?key=AIzaSyAk6YaY79hLIZRAx-ymE-ZGJ701t-sd_Q0'></script>

<script type='text/javascript'>
    jQuery(function ($) {
        function init_map1() {
            var myLocation = new google.maps.LatLng(38.885516, -77.09327200000001);
            var mapOptions = {
                center: myLocation,
                zoom: 16
            };
            var marker = new google.maps.Marker({
                position: myLocation,
                title: 'Property Location'
            });
            var map = new google.maps.Map(document.getElementById('map1'),
                mapOptions);
            marker.setMap(map);
        }
        init_map1();
    });
</script>

<style>
    .map {
        min-width: 300px;
        min-height: 300px;
        width: 100%;
        height: 100%;
    }

    .header {
        background-color: #F5F5F5;
        color: #36A0FF;
        height: 70px;
        font-size: 27px;
        padding: 10px;
    }
</style>

<!-- Formulario de contacto -->

<?php

    include_once("footer.php");

?>