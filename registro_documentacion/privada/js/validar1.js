"use strict";

// Expresiones regulares comunes

function validar(tipoFormulario) {
  const form = document.formu;
  let isValid = true;

  // Limpiar mensajes de error anteriores
  limpiarMensajesError();

  switch(tipoFormulario) {
    case 'habitaciones':
      isValid = validarCampo(form.tipo_habitacion_pk, "El valor está vacío") && isValid;
      isValid = validarRegex(form.descripcion, v33, "La descripcion es incorrecta o el campo está vacío") && isValid;
      isValid = validarRegex(form.precio, v22, "El precio es incorrecto o el campo está vacío") && isValid;
      isValid = validarRegex(form.foto, v33, "La foto es incorrecto o el campo está vacío") && isValid;
      break;
    case 'circulares':
      isValid = validarCampo(form.id_documento, "el id está vacío") && isValid;
      isValid = validarRegex(form.de, v33, " el campo está vacío") && isValid;
      isValid = validarRegex(form.para, v33, " el campo está vacío") && isValid;
      isValid = validarRegex(form.numero, v33, " el campo está vacío") && isValid;
    break;

    default:
      mostrarError(form, "Tipo de formulario no reconocido");
      isValid = false;
  }

  if (isValid) {
    mostrarMensajeExito("DATOS CORRECTOS");
    form.submit();
  }

  return isValid;
}

function validarCampo(campo, mensaje) {
  if (campo.value === "") {
    mostrarError(campo, mensaje);
    return false;
  }
  return true;
}

function validarRegex(campo, regex, mensaje) {
  if (!regex.test(campo.value)) {
    mostrarError(campo, mensaje);
    return false;
  }
  return true;
}

function validarSelect(id, mensaje) {
  const select = document.getElementById(id);
  if (select.value == 0 || select.value == "") {
    mostrarError(select, mensaje);
    return false;
  }
  return true;
}

function mostrarError(campo, mensaje) {
  const errorDiv = document.createElement('div');
  errorDiv.className = 'error-message';
  errorDiv.textContent = mensaje;
  campo.parentNode.insertBefore(errorDiv, campo.nextSibling);
  campo.classList.add('error');
}

function limpiarMensajesError() {
  const errores = document.querySelectorAll('.error-message');
  errores.forEach(error => error.remove());
  const camposError = document.querySelectorAll('.error');
  camposError.forEach(campo => campo.classList.remove('error'));
}

function mostrarMensajeExito(mensaje) {
  const exitoDiv = document.createElement('div');
  exitoDiv.className = 'success-message';
  exitoDiv.textContent = mensaje;
  document.formu.parentNode.insertBefore(exitoDiv, document.formu);
}