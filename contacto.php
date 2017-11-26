<?php
    include_once("menu.php");
    if(isset($_POST['enviar'])){
        $destino = 'seguimiento_practicas@hotmail.com';
        $asunto = "Mensaje enviado por: ".$_POST['nombre'];
        $remitente = $_POST['email'];
        $mensaje = 'Formulario de contacto de la revista';
        $mensaje .= '\nNombre: '.$_POST['nombre'];
        $mensaje .= '\nApellidos: '.$_POST['apellidos'];
        $mensaje .= '\nEmail: '.$_POST['email'];
        $mensaje .= '\nTeléfono: '.$_POST['telefono'];
        $mensaje .= '\nMensaje: '.$_POST['mensaje'];
        if(mail($destino,$asunto,$mensaje)){
            echo ("
                <div class='alert alert-info fade in'>
                  <h4 class='text-center'>Mensaje enviado correctamente. Gracias por contactar con nosotros.</h4>
                </div>
            ");
        }else{
            echo ("
                <div class='alert alert-danger fade in'>
                  <h4 class='text-center' style='margin: 0;'>No se pudo mandar el mensaje, por favor intentalo más tarde</h4>
                </div>
            ");            
        }
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
                                <input id='nombre' name='nombre' type='text' placeholder='Nombre' class='form-control' required>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='apellidos' name='apellidos' type='text' placeholder='Apellidos' class='form-control' required>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='email' name='email' type='text' placeholder='Direcci&oacute;n de correo' class='form-control' required>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <input id='teleno' name='telefono' type='text' placeholder='Tel&eacute;fono' class='form-control' required>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-10 col-md-offset-1'>
                                <textarea class='form-control' id='mensaje' maxlength="300" minlength="10" name='mensaje' placeholder='Pon tu mensaje aqu&iacute;.' rows='7' required></textarea>
                                <span class="help-block text-center" id="ayuda" style="display: none;">M&aacute;ximo 300 car&aacute;cteres</span>
                                <script>
                                    $('textarea').focus(function(){
                                        jQuery('#ayuda').show();
                                    })
                                    $('textarea').focusout(function(){
                                        jQuery('#ayuda').hide();
                                    })
                                </script>
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
                    <div class='text-center header'>Revista Coches</div>
                    <div class='panel-body text-center'>
                        <h4>Revista Coches</h4>
                        <div>Antonio Lopez, 28</div>
                        <div>Madrid, Espa&ntilde;a</div>
                        <div>revista@revista.com</div>
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
            var myLocation = new google.maps.LatLng(40.3964447, -3.7134246);
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

<!-- Formulario de contacto -->

<?php
    include_once("footer.php");
?>