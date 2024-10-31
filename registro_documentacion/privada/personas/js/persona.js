"use strict"
function validar1() {


  var ci = document.formu.ci.value;
  var ap = document.formu.ap.value;
  var am = document.formu.am.value;
  var nombres = document.formu.nombres.value;

  if (ci == ""){
    alert("El ci es incorrectos o el campo esta vacio");
    document.formu.ci.focus();
    return;
  }
  if (ap !="") {
    if (!v1.test(ap)) {
      alert("El apellido paterno es incorrecto");
      document.form.ap.focus();
      return;
    }  
  } 
  if (am != ""){
    if (!v1.test(am)){
        alert("El apellido materno es incorrecto");
        document.formu.am.focus();
        return;         
    }
  }

  if ((ap || am) ==""){
    alert("Unode los apellidos tiene que ser llenado");
    document.formu.ap.focus();
    return;         
}
  if ( !v1.test(nombres)){
    alert("El nombre es incorrectos o el campo esta vacio");
    document.formu.nombres.focus();
    return;
  }
  

 alert("DATOS CORRECTOS:\n");
 document.formu.submit();

}
