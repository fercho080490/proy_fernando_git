<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='../js/validar.js'></script>
         <style>
           .form-container {
               display: flex;
               flex-direction: column;
               align-items: center;
               max-width: 800px; /* Adjust as needed */
               margin: 0 auto;
           }
           .form-row {
               display: flex;
               justify-content: space-between;
               width: 100%;
           }
           .form-column {
               flex: 1;
               padding: 0 20px;
           }
           .form-group {
               display: flex;
               flex-direction: column; /* Stack label and input vertically */
               width: 100%;
               margin: 10px 0;
           }
           .form-group label {
               text-align: left; /* Align label text to the left */
               padding-right: 10px;
           }
           .form-group input {
               padding: 8px;
               box-sizing: border-box; /* Include padding in width */
           }
           .error {
               color: red;
               font-size: 0.9em;
               margin-top: 5px; /* Space above the error message */
           }
           .form-buttons {
               margin-top: 20px;
               display: flex;
               justify-content: center;
           }
           .form-buttons input {
               background-color: #4CAF50; /* Green color for submit button */
               color: white;
               padding: 10px 20px;
               border: none;
               border-radius: 4px;
               cursor: pointer;
               margin: 0 10px;
           }
           .form-buttons input[type='reset'] {
               background-color: #f44336; /* Red color for cancel button */
           }

           /* Responsive Styles */
           @media (max-width: 768px) {
               .form-row {
                   flex-direction: column; /* Stack columns vertically on smaller screens */
               }
               .form-column {
                   width: 100%; /* Full width for each column */
                   padding: 0; /* Remove padding for smaller screens */
               }
               .form-buttons {
                   flex-direction: column; /* Stack buttons vertically */
                   align-items: center; /* Center buttons */
               }
               .form-buttons input {
                   width: 100%; /* Full width for buttons */
                   margin: 5px 0; /* Add some space between buttons */
               }
           }
         </style>
         <script>
           function validar() {
               // Clear previous error messages
               const errorElements = document.querySelectorAll('.error');
               errorElements.forEach(el => el.textContent = '');

               let isValid = true;

               // Validate CI
               const ci = document.getElementById('ci').value;
               const ciRegex = /^[0-9]{1,10}$/; // Example regex: only numbers, up to 10 digits
               if (!ci) {
                   document.getElementById('ciError').textContent = 'CI es requerido.';
                   isValid = false;
               } else if (!ciRegex.test(ci)) {
                   document.getElementById('ciError').textContent = 'CI debe ser un número válido (hasta 10 dígitos).';
                   isValid = false;
               }

               // Validate Nombres
               const nombres = document.getElementById('nombres').value;
               if (!nombres) {
                   document.getElementById('nombresError').textContent = 'Nombres son requeridos.';
                   isValid = false;
               }

               // Validate Materno (am)
               const am = document.getElementById('am').value;
               if (!am) {
                   document.getElementById('amError').textContent = 'El apellido materno es requerido.';
                   isValid = false;
               }

               // Validate Dirección
               const direccion = document.getElementById('direccion').value;
               if (!direccion) {
                   document.getElementById('direccionError').textContent = 'La dirección es requerida.';
                   isValid = false;
               } else if (direccion.length < 5) {
                   document.getElementById('direccionError').textContent = 'La dirección debe tener al menos 5 caracteres.';
                   isValid = false;
               }

               // If valid, submit the form
               if (isValid) {
                   document.forms['formu'].submit();
               }
           }
         </script>
       </head>
       <body>
       <h1>INSERTAR PERSONA</h1>";

echo "<form action='persona_nuevo1.php' method='post' name='formu' class='form-container'>";
echo "  <div class='form-row'>
            <div class='form-column'>
                <div class='form-group'>
                    <label for='ci'><b>(*)CI</b></label>
                    <input type='text' name='ci' id='ci'>
                    <span id='ciError' class='error'></span> <!-- Error message for CI -->
                </div>
                <div class='form-group'>
                    <label for='nombres'><b>(*)Nombres</b></label>
                    <input type='text' name='nombres' id='nombres' onkeyup='this.value=this.value.toUpperCase()'>
                    <span id='nombresError' class='error'></span> <!-- Error message for Nombres -->
                </div>
            </div>
            <div class='form-column'>
                <div class='form-group'>
                    <label for='ap'><b>Paterno</b></label>
                    <input type='text' name='ap' id='ap' onkeyup='this.value=this.value.toUpperCase()'>
                </div>
                <div class='form-group'>
                    <label for='am'><b>(*)Materno</b></label>
                    <input type='text' name='am' id='am' onkeyup='this.value=this.value.toUpperCase()'>
                    <span id='amError' class='error'></span> <!-- Error message for Materno -->
                </div>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-column'>
                <div class='form-group'>
                    <label for='direccion'><b>(*)Dirección</b></label>
                    <input type='text' name='direccion' id='direccion' onkeyup='this.value=this.value.toUpperCase()'>
                    <span id='direccionError' class='error'></span> <!-- Error message for Dirección -->
                </div>
            </div>
            <div class='form-column'>
                <div class='form-group'>
                    <label for='telefono'><b>Telefono</b></label>
                    <input type='text' name='telefono' id='telefono'>
                </div>
            </div>
        </div>
        <div class='form-buttons'>  
            <input type='button' name='enviar' class='boton' value='ENVIAR' onclick='validar();'>
            <input type='reset' name='cancela' class='boton' value='CANCELAR'>
        </div>
      </form>";

echo "</body>
      </html>";
?>
