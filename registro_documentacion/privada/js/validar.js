function validarFormulario(button) {

    const form = button.closest('.formulario');

    const errorElements = form.querySelectorAll('.error');
    errorElements.forEach(el => el.textContent = '');

    let isValid = true;

    const inputs = form.querySelectorAll('input');

    inputs.forEach(input => {
        const value = input.value.trim(); 
        const id = input.id;


        switch (id) {
            case 'ci':
                if (!value) {
                    document.getElementById('ciError').textContent = 'CI es requerido.';
                    isValid = false;
                } else if (!/^[0-9]{1,10}$/.test(value)) {
                    document.getElementById('ciError').textContent = 'CI debe ser un número válido.';
                    isValid = false;
                }
                break;

            case 'nombres':
                if (!value) {
                    document.getElementById('nombresError').textContent = 'Nombres son requeridos.';
                    isValid = false;
                } else if (!/^[a-zA-Z\s]+$/.test(value)) {
                    document.getElementById('nombresError').textContent = 'Nombres solo pueden contener letras.';
                    isValid = false;
                }
                break;

            case 'telefono':
                if (!value) {
                    document.getElementById('telefonoError').textContent = 'Teléfono es requerido.';
                    isValid = false;
                } else if (!/^[0-9]{1,10}$/.test(value)) {
                    document.getElementById('telefonoError').textContent = 'Teléfono solo puede contener números.';
                    isValid = false;
                }
                break;

            case 'direccion':
                if (!value) {
                    document.getElementById('direccionError').textContent = 'La dirección es requerida.';
                    isValid = false;
                } else if (value.length < 5) {
                    document.getElementById('direccionError').textContent = 'La dirección debe tener al menos 5 caracteres.';
                    isValid = false;
                } else if (!/^[a-zA-Z0-9\s]+$/.test(value)) {
                    document.getElementById('direccionError').textContent = 'La dirección solo puede contener letras y números.';
                    isValid = false;
                }
                break;

        }
    });

    if (isValid) {
        form.submit();
    }
}