<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/secretaria.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1>INSERTAR NUEVA SECRETARIA</h1>";

$sql_areas = $db->Prepare("SELECT id_area, nombre FROM Areas WHERE estado = 'A'");
$rs_areas = $db->GetAll($sql_areas);

$sql_empresas = $db->Prepare("SELECT id_emp, nombre FROM empresa WHERE estado = 'A'");
$rs_empresas = $db->GetAll($sql_empresas);

echo "<form action='secretaria_nuevo1.php' method='post' name='formu'>";
echo "<center>
        <table class='listado'>
          <tr>
            <th>(*)Nombre</th>
            <td><input type='text' name='nombre' size='30' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <th>(*)Área</th>
            <td>
              <select name='id_area'>
                <option value=''>-- Seleccione --</option>";
                foreach ($rs_areas as $fila) {
                  echo "<option value='".$fila['id_area']."'>".$fila['nombre']."</option>";
                }
echo "      </select>
            </td>
          </tr>
          <tr>
            <th>(*)Empresa</th>
            <td>
              <select name='id_emp'>
                <option value=''>-- Seleccione --</option>";
                foreach ($rs_empresas as $fila) {
                  echo "<option value='".$fila['id_emp']."'>".$fila['nombre']."</option>";
                }
echo "      </select>
            </td>
          </tr>
          <tr>
            <td align='center' colspan='2'>  
              <input type='button' value='Aceptar' onclick='validar()'>
              <input type='button' value='Cancelar' onclick='location.href=\"secretaria.php\"'>
              (*)Datos Obligatorios
            </td>
          </tr>
        </table>
      </center>";
echo "</form>";

echo "</body>
      </html>";
?>