//Comprueba que las contraseñas sean de 8 carácteres y sean iguales
function validar(){
	var pass1 = document.getElementById("pass_1").value;
	var pass2 = document.getElementById("pass_2").value;
	if(pass1.length < 8){
		alert("La contraseña debe tener 8 caracteres");
		return false;
	}else if(pass1!=pass2){
		alert("Las contraseñas no coinciden");
		return false;
	}
	return true;
}

//Comprueba que hayamos seleccionado uno diferente al defaul
function seleccionado(){
	var selec = document.getElementById('selec').value
	if (selec=="vacio"){
		alert ("Debes seleccionar uno de la lista");
		return false;
	}
	return true;
}

//Comprueba que haya un archivo para subirse
function subido(){
	var archivo = document.getElementById("archivo").value;
	if (archivo.length==0){
		alert ("Debes seleccionar una portada");
		return false;
	}
}

//Compruba el estado, si es diferente a vacio, cambia el estado de los input
function checkOption(obj) {
    var input = document.getElementsByName("nombre");
    var input2 = document.getElementsByName("apellidos");
    for(var i=0; i < input.length; i++) {
     input[i].disabled = !(obj.value == "vacio")
    }
    for(var i=0; i < input2.length; i++) {
     input2[i].disabled = !(obj.value == "vacio")
    }
}