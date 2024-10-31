<?php
session_start();
require_once("../../conexion.php");

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_secretaria = $_POST["id_secretaria"];
$nombre = $_POST["nombre"];
$id_area = $_POST["id_area"];
$id_emp = $_POST["id_emp"];

if(($nombre!="") and ($id_area!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["id_area"] = $id_area;
   $reg["fec_modificacion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("Secretarias", $reg, "UPDATE", "id_secretaria='".$id_secretaria."'");
   header("Location: secretaria.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
   echo "<div class='mensaje'>";
   $mensaje = "NO SE MODIFICARON LOS DATOS DE LA SECRETARIA";
   echo "<h1>".$mensaje."</h1>";
   echo "<a href='secretaria.php'>
             <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
         </a>";
   echo "</div>";
}
echo "</body>
      </html>";
?>