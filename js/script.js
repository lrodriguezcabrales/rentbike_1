function validar(value) {
	

	var name = document.getElementById('name');
	validateText(name, name.value);

}

/**	
 * Validar que sea solo letras
 */
function validateText(field, value) {
  var patron = /^[a-zA-Z\s]*$/;
  
  var info = '<label>Solo letras</label>';

  var parent = field.parentNode();

  if(!value.search(patron)){
  	alert ('Ok');
    field.style.background = 'none';
  }else{
  	alert ('Texto no valido');
    //field.css('color', '#efc8c8')
    field.style.background = '#efc8c8';
    parent.appendChild(info);
  }
    
}

/**
 * Validar que no este vacio
 */
function validateEmpty(value){

}