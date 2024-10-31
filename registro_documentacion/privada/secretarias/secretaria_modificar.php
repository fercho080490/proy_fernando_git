<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$id_secretaria = $_POST["id_secretaria"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/secretaria.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1>MODIFICAR SECRETARIA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM Secretarias
                     WHERE id_secretaria = ?
                     AND estado = 'A'");
$rs = $db->GetAll($sql, array($id_secretaria));

$sql_areas = $db->Prepare("SELECT id_area, nombre FROM Areas WHERE estado = 'A'");
$rs_areas = $db->GetAll($sql_areas);

echo "<form action='secretaria_modificar1.php' method='post' name='formu'>";
echo "<center>
        <table class='listado'>
          <tr>
            <th>(*)Nombre</th>
            <td><input type='text' name='nombre' size='30' onkeyup='this.value=this.value.toUpperCase()' value='".$rs[0]["nombre"]."'></td>
          </tr>
          <tr>
            <th>(*)Área</th>
            <td>
              <select name='id_area'>";
              foreach ($rs_areas as $fila) {
                $selected = ($fila['id_area'] == $rs[0]['id_area']) ? 'selected' : '';
                echo "<option value='".$fila['id_area']."' ".$selected.">".$fila['nombre']."</option>";
              }
echo "      </select>
            </td>
          </tr>
          <tr>
            <td align='center' colspan='2'>  
              <input type='button' value='Aceptar' onclick='validar()'>
              <input type='button' value='Cancelar' onclick='location.href=\"secretaria.php\"'>
              (*)Datos Obligatorios
              <input type='hidden' name='id_secretaria' value='".$rs[0]["id_secretaria"]."'>
              <input type='hidden' name='id_emp' value='".$rs[0]["id_emp"]."'>
            </td>
          </tr>
        </table>
      </center>";
echo "</form>";

echo "</body>
      </html>";
?>