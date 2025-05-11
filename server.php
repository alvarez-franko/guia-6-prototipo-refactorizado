<?php
/**
 * DEBUG MODE
 */

//Importante: esto debe desactivarse en producción (sitios reales)
ini_set('display_errors', 1); //muestra errores en pantalla
error_reporting(E_ALL); //muestra todos los tipos de errores (notices, warnings, fatales, etc.)

header("Access-Control-Allow-Origin: *"); //permite que cualquier frontend acceda al backend
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type"); //permite que el navegador envíe encabezados personalizados

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

/**
 * Incluye el archivo que define las rutas o la lógica que responderá a la petición actual.
 * Usa require_once para incluirlo solo una vez (evita errores por múltiples inclusiones).
 * Este archivo debería analizar la URL, método y decidir qué controlador invocar.
 */

$module = $_GET['module'] ?? 'students';
if ($module === 'students') {
    require_once("./routes/studentsRoutes.php");
} elseif ($module === 'teachers') {
    require_once("./routes/teachersRoutes.php");
} else {
    echo json_encode(["error" => "Error 404: ruta no reconocida."]);
}

//lineas 25 a 32 no testeadas.
?>