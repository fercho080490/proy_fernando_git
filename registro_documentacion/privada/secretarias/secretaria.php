<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
//$db->debug = true;

echo "<html>
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='../js/validar.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>";

contarRegistros($db, "Secretarias");
paginacion("secretaria.php?");

$sql3 = $db->Prepare("SELECT s.*, a.nombre as nombre_area, e.nombre as nombre_empresa
                      FROM Secretarias s
                      INNER JOIN Areas a ON s.id_area = a.id_area
                      INNER JOIN empresa e ON s.id_emp = e.id_emp
                      WHERE s.estado <> 'X'
                      ORDER BY s.id_secretaria DESC
                      LIMIT ? OFFSET ?");

$rs = $db->GetAll($sql3, array($nElem, $regIni));

if ($rs) {
    echo "<center>
              <h1>LISTADO DE SECRETARIAS</h1>
              <b><a href='secretaria_nuevo.php'>Nueva Secretaria>>>></a></b>
              <table class='listado'>
                <tr>
                  <th>Nro</th>
                  <th>Nombre</th>
                  <th>Área</th>
                  <th>Empresa</th>
                  <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th>
                  <th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
                </tr>";

    $b = $regIni + 1;

    foreach ($rs as $fila) {
        echo "<tr>
                <td align='center'>{$b}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['nombre_area']}</td>
                <td>{$fila['nombre_empresa']}</td>
                <td align='center'>
                  <form name='formModif{$fila["id_secretaria"]}' method='post' action='secretaria_modificar.php'>
                    <input type='hidden' name='id_secretaria' value='{$fila['id_secretaria']}'>
                    <a href='javascript:document.formModif{$fila['id_secretaria']}.submit();' title='Modificar Secretaria'>
                      Modificar>>
                    </a>
                  </form>
                </td>
                <td align='center'>
                  <form name='formElimi{$fila["id_secretaria"]}' method='post' action='secretaria_eliminar.php'>
                    <input type='hidden' name='id_secretaria' value='{$fila['id_secretaria']}'>
                    <a href='javascript:document.formElimi{$fila['id_secretaria']}.submit();' title='Eliminar Secretaria' onclick='return confirm(\"Desea realmente eliminar esta secretaria: {$fila['nombre']}?\");'>
                      Eliminar>>
                    </a>
                  </form>
                </td>
             </tr>";
        $b++;
    }
    echo "</table>
          </center>";
}

mostrar_paginacion();
echo "</body>
      </html>";
?>

