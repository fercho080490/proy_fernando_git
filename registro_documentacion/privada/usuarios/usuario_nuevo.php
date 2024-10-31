<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html>
      <head>
      <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <script src='../js/expresiones_regulares.js'></script>
        <script src='js/usuario.js'></script>
        <script type='text/javascript' src='../../ajax.js'></script>
        <script type='text/javascript'>
        function buscar() {
          var d1, contenedor, url;
          contenedor = document.getElementById('personas');
          contenedor2 = document.getElementById('persona_seleccionado');
          contenedor3 = document.getElementById('persona_insertada');
          d1 = document.formu.ap.value;
          d2 = document.formu.am.value;
          d3 = document.formu.nombres.value;
          d4 = document.formu.ci.value;
          ajax = nuevoAjax();
          url = 'ajax_buscar_persona.php';
          param = 'ap='+d1+'&am='+d2+'&nombres='+d3+'&ci='+d4;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          ajax.onreadystatechange = function() {
          if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = '';
            }
          }
          ajax.send(param);
        }

      function buscar_persona(id_persona) {
        var d1, contenedor, url;
        contenedor = document.getElementById('persona_seleccionado');
        contenedor2 = document.getElementById('personas');
        document.formu.id_persona.value = id_persona;

    d1 = id_persona;
    ajax = nuevoAjax();
    url = 'ajax_buscar_persona1.php';
    param = 'id_persona='+d1;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
        contenedor.innerHTML = ajax.responseText;
        contenedor2.innerHTML = '';
      }
    }
    ajax.send(param);
    }

        function insertar_persona() {
          var d1, contenedor, url;
          contenedor = document.getElementById('persona_seleccionado');
          contenedor2 = document.getElementById('personas');
          contenedor3 = document.getElementById('persona_insertada');
          d1 = document.formu.ap1.value;
          d2 = document.formu.am1.value;
          d3 = document.formu.nombres1.value;
          d4 = document.formu.ci1.value;
          d5 = document.formu.direccion1.value;
          d6 = document.formu.telefono1.value;
          f = document.formu.genero1[0].checked;
          m = document.formu.genero1[1].checked;
          if (f == true)
            d7= 'f';
          else if(m == true)
            d7 = 'm';
          else
            d7 = '';

          if (d4 == '') {
            alert('El Ci es incorrecto o el campo esta vacio');
            document.formu.ci1.focus();
            return;
          }
          if ((d1=='') && (d2=='')) {
            alert('Por favor introduzca un Apellido');
            document.formu.ap1.focus();
            return;
          }
          if (d3 == '') {
            alert('El Nombre es incorrecto o el campo esta vacio');
            document.formu.nombres1.focus();
            return;
          }
          if (d7 == ''){
            alert('El Genero esta vacio');
            return;
          }
        ajax = nuevoAjax();
        url = 'ajax_inserta_persona.php';
        param = 'ap1='+d1+'&am1='+d2+'&nombres1='+d3+'&ci1='+d4+'&direccion1='+d5+'&telefono1='+d6+'&genero1='+d7;
        ajax.open('POST', url, true);
        ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        alert('llega');
        ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
          contenedor.innerHTML = '';
          contenedor2.innerHTML = '';
          contenedor3.innerHTML = ajax.responseText;
          }
        }
        ajax.send(param);
        }
      </script>
       </head>";
       echo"<body>
       <p> &nbsp;</p>
         <h1>INSERTAR USUARIO</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) as persona, id_persona
                     FROM personas
                     WHERE estado = 'A'                        
                        ");
$rs = $db->GetAll($sql);
        echo"<form action='usuario_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*) Selecciona a la Personas</th>
                      <td>
                        <table>
                          <tr>
                            <td>
                              <b>Paterno</b><br/>
                              <input type='text' name='ap' value='' size='10' onkeyUp='buscar()'>
                            </td>
                            <td>
                              <b>Materno</b><br/>
                              <input type='text' name='am' value='' size='10' onKeyUp='buscar()'>
                            </td>
                            <td>
                              <b>Nombres</b><br/>
                              <input type='text' name='nombres' value='' size='10' onKeyUp='buscar()'>
                            </td>
                            <td>
                              <b>C.I.</b><br/>
                              <input type='text' name='ci' value='' size='10' onKeyUp='buscar()'>
                            </td>
                          </tr>
                        </table>
                      </td>
                  </tr>";
echo"<tr>
        <td colspan='6' align='center'>
          <table width='100%'>
            <tr>
              <td colspan='3' align='center'>
              <div id='personas'></div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan='6' align='center'>
          <table width='100%'>
            <tr>
              <td colspan='3'>
              <div id='persona_seleccionado'></div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan='6' align='center'>
          <table width='100%'>
            </tr>
              <td colspan='3'>
              <input type='hidden' name='id_persona'>
              <div id='persona_insertada'></div>
              </td>
            </tr>
          </table>
        </td>
      </tr>";
             echo"<tr>
                    <th><b>(*) Nombre de usuario</b></th>
                    <td><input type='text' name='usuario1' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*) Clave</b></th>
                    <td><input type='password' name='clave' size='10'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>
                      <input type='button' value='ACEPTAR' onclick='validar()'>
                      <input type='reset' value='CANCELAR'><br>
                     
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/
echo "</body>
      </html> ";

 ?>