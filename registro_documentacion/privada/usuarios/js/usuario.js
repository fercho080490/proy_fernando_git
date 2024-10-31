"use strict"
function validar() {

  var id_persona = document.formu.id_persona.value;
  var usuario1 = document.formu.usuario1.value;
  var clave = document.formu.clave.value; 

  if (id_persona==""){
    alert("El valor de persona esta vacio");
    document.formu.id_persona.focus();
    return;
  } 
  if (usuario1==""){
    alert("El valor de usuario esta vacio");
    document.formu.usuario1.focus();
    return;
  } 
  if (clave==""){
    alert("El valor de clave esta vacio");
    document.formu.clave.focus();
    return;
  } 
 alert("DATOS CORRECTOS:\n");
document.formu.submit();
}
