<?php
session_start();
require_once("../../conexion.php");

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$nombre = $_POST["nombre"];
$id_area = $_POST["id_area"];
$id_emp = $_POST["id_emp"];

if(($nombre!="") and ($id_area!="") and ($id_emp!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["id_area"] = $id_area;
   $reg["id_emp"] = $id_emp;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["fec_modificacion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"]; 
   $reg["estado"] = 'A';
     
   $rs1 = $db->AutoExecute("Secretarias", $reg, "INSERT"); 
   header("Location: secretaria.php");
   exit();
} else {
   echo "<div class='mensaje'>";
   $mensaje = "NO SE INSERTARON LOS DATOS DE LA SECRETARIA";
   echo "<h1>".$mensaje."</h1>";
   echo "<a href='secretaria_nuevo.php'>
             <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
         </a>";
   echo "</div>";
}

echo "</body>
      </html>";
?>