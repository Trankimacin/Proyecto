function validacion(){

	var txt       = "";
	var nombre    = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;
	var email     = document.getElementById("email").value;
	var mensaje   = document.getElementById("mensaje").value;

	if( nombre == null || nombre.length == 0 || /[^a-zA-Z\-]+/.test(nombre)){
		txt = 'El nombre debe introducirse';
		document.getElementById("validar").innerHTML = txt;
		return false;
	}else{
		if( apellidos == null || apellidos.length == 0 || /[^a-zA-Z\-]+/.test(apellidos)){
		txt = 'Los apellidos deben introducirse';
		document.getElementById("validar2").innerHTML = txt;
		return false;
		}else{
			if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email))) {
				txt = 'El email no tiene un formato correcto';
				document.getElementById("validar3").innerHTML = txt;
				return false;
			}else{
				if (mensaje == null || mensaje.length == 0){
					txt = 'El mensaje no puede estar vacio';
					document.getElementById("validar4").innerHTML = txt;
					return false;
				}
			}
		}
	}
}