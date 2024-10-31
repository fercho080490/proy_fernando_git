<?php
session_start();
require_once("../../conexion.php");

$id_secretaria = $_REQUEST["id_secretaria"];
$debug = isset($_REQUEST["debug"]) ? true : false;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

// Función para imprimir información de depuración
function debug_print($message) {
    global $debug;
    if ($debug) {
        echo "<pre>DEBUG: " . print_r($message, true) . "</pre>";
    }
}

// Verificar si la secretaria existe
$sql_check = $db->Prepare("SELECT * FROM secretarias WHERE id_secretaria = ? AND estado <> 'X'");
$rs_check = $db->GetRow($sql_check, array($id_secretaria));

if (!$rs_check) {
    echo "<div class='mensaje'><h1>La secretaria no existe o ya ha sido eliminada.</h1></div>";
    exit();
}

debug_print("Secretaria encontrada: " . print_r($rs_check, true));

// Verificar si la secretaria está siendo referenciada en otras tablas
// Nota: Ajusta esta consulta según las relaciones reales de tu base de datos
$sql = $db->Prepare("SELECT 
                        (SELECT COUNT(*) FROM circulares WHERE id_secretaria = ? AND estado <> 'X') as circulares_count
                    ");
$rs = $db->GetRow($sql, array($id_secretaria));

debug_print("Resultados de la verificación: " . print_r($rs, true));

$total_referencias = $rs['circulares_count'];

if ($total_referencias == 0) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $reg["fec_modificacion"] = date("Y-m-d H:i:s");
    
    try {
        $rs1 = $db->AutoExecute("secretarias", $reg, "UPDATE", "id_secretaria='".$id_secretaria."'");
        if ($rs1) {
            header("Location: secretarias.php");
            exit();
        } else {
            throw new Exception("No se pudo actualizar el estado de la secretaria.");
        }
    } catch (Exception $e) {
        echo "<div class='mensaje'><h1>Error al eliminar la secretaria: " . $e->getMessage() . "</h1></div>";
        debug_print("Error en la base de datos: " . $db->ErrorMsg());
    }
} else {
    require_once("../../libreria_menu.php");
    echo "<div class='mensaje'>";
    $mensaje = "NO SE ELIMINÓ LA SECRETARIA PORQUE ESTÁ SIENDO UTILIZADA EN OTRAS TABLAS";
    echo "<h1>".$mensaje."</h1>";
    if ($debug) {
        echo "<p>Detalles:</p>";
        echo "<ul>";
        echo "<li>Circulares: " . $rs['circulares_count'] . "</li>";
        echo "</ul>";
    }
    echo "<a href='secretarias.php'>
              <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
          </a>";
    echo "</div>";
}

echo "</body>
</html>";
?>