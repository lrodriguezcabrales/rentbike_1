function validar(value) {
	

	var name = document.formrent.name;
	validateText(name, name.value);

	alert('entro ');

}

/**	
 * Validar que sea solo letras
 */
function validateText(field, value) {
  var patron = /^[a-zA-Z\s]*$/;
  
  if(!value.search(patron)){
  	alert ('Ok');
  }else{
  	alert ('Texto no valido');
  	//field.css('color', 'red');
  }
    
}

/**
 * Validar que no este vacio
 */
function validateEmpty(value){

}