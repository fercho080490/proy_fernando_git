function validar() {
  var nombre = document.formu.nombre.value;
  var id_area = document.formu.id_area.value;
  var id_emp = document.formu.id_emp ? document.formu.id_emp.value : null;

  if (nombre == "") {
      alert("Por favor, ingrese el nombre de la secretaria");
      document.formu.nombre.focus();
      return;
  }

  if (id_area == "") {
      alert("Por favor, seleccione un área");
      document.formu.id_area.focus();
      return;
  }

  if (id_emp != null && id_emp == "") {
      alert("Por favor, seleccione una empresa");
      document.formu.id_emp.focus();
      return;
  }

  document.formu.submit();
}