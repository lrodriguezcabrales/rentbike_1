function validar(value) {
	

	var name = document.getElementById('name');
	validateText(name, name.value);

  var lastname = document.getElementById('lastname');
  validateText(lastname, lastname.value);

  var email = document.getElementById('email');
  validateEmail(email, email.value);
}

/**	
 * Validar que sea solo letras
 */
function validateText(field, value) {
  var patron = /^[a-zA-Z\s]*$/; 
  
  if(!value.search(patron)){
    field.style.background = '#ffffff';
  }else{
  	alert ('El campo ('+field.name+') solo admite letras.');
    field.style.background = '#efc8c8';
  }
    
}

/** 
 * Validar email
 */
function validateEmail(field, value) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
    if (!expr.test(email)){
      alert("La dirección de correo es incorrecta.");
      field.style.background = '#efc8c8';   
    }
       
}

/** 
 * Validar telefono celular
 */
function validateMovil(field, value) {
  var patron = /^[0-9]{10}$/; 
  
  if(!value.search(patron)){
    field.style.background = '#ffffff';
  }else{
    alert ('El telefono celular debe tener 10 digitos');
    field.style.background = '#efc8c8';
  }
    
}


/**
 * Validar que no este vacio
 */
function validateEmpty(value){

}