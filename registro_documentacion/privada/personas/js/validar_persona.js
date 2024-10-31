function validar() {
    const errorElements = document.querySelectorAll('.error');
    errorElements.forEach(el => el.textContent = '');

    let isValid = true;

    const ci = document.getElementById('ci').value;
    const ciRegex = /^[0-9]{1,10}$/; 
    if (!ci) {
        document.getElementById('ciError').textContent = 'CI es requerido.';
        isValid = false;
    } else if (!ciRegex.test(ci)) {
        document.getElementById('ciError').textContent = 'CI debe ser un número válido';
        isValid = false;
    }
    const nombres = document.getElementById('nombres').value;
    const nameRegex = /^[a-zA-Z\s]+$/; 
    if (!nombres) {
        document.getElementById('nombresError').textContent = 'Nombres son requeridos.';
        isValid = false;
    } else if (!nameRegex.test(nombres)) {
        document.getElementById('nombresError').textContent = 'Nombres solo pueden contener letras.';
        isValid = false;
    }
    const ap = document.getElementById('ap').value;
    if (!ap) {
        document.getElementById('apError').textContent = 'Apellido paterno es requerido.';
        isValid = false;
    } else if (!nameRegex.test(ap)) {
        document.getElementById('apError').textContent = 'Apellido paterno solo puede contener letras.';
        isValid = false;
    }
    const am = document.getElementById('am').value;
    if (!am) {
        document.getElementById('amError').textContent = 'El apellido materno es requerido.';
        isValid = false;
    } else if (!nameRegex.test(am)) {
        document.getElementById('amError').textContent = 'Apellido materno solo puede contener letras.';
        isValid = false;
    }
    const direccion = document.getElementById('direccion').value;
    const addressRegex = /^[a-zA-Z0-9\s]+$/; 
    if (!direccion) {
        document.getElementById('direccionError').textContent = 'La dirección es requerida.';
        isValid = false;
    } else if (!addressRegex.test(direccion)) {
        document.getElementById('direccionError').textContent = 'La dirección solo puede contener letras y números.';
        isValid = false;
    }
    const telefono = document.getElementById('telefono').value;
    const phoneRegex = /^[0-9]{1,10}$/;
    if (!telefono) {
        document.getElementById('telefonoError').textContent = 'Teléfono es requerido.';
        isValid = false;
    } else if (!phoneRegex.test(telefono)) {
        document.getElementById('telefonoError').textContent = 'Teléfono solo puede contener números.';
        isValid = false;
    }
    if (isValid) {
        document.forms['formu'].submit();
    }
}
    const direccion = document.getElementById('direccion').value;
    if (!direccion) {
        document.getElementById('direccionError').textContent = 'La dirección es requerida.';
        isValid = false;
    } else if (direccion.length < 5) {
        document.getElementById('direccionError').textContent = 'La dirección esta vacio';
        isValid = false;
    }
    if (isValid) {
        document.forms['formu'].submit();
    }

