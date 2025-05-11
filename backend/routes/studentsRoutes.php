<?php

/**
 * Este archivo se encarga de:
 * 
 * Conectar a la base de datos.
 * Incluir el controlador que maneja la lógica del CRUD.
 * Delegar las peticiones al controlador según el método HTTP usado (GET, POST, PUT, DELETE).
 */


/**
* Incluye el archivo de configuración de la base de datos.
* Crea y expone la variable $conn que se usará para interactuar con MySQLi.
* Se usa require_once para evitar duplicación si este archivo ya fue incluido antes.
*/
require_once("./config/databaseConfig.php");

/**
 * Incluye el archivo que contiene las funciones handleGet(), handlePost(), etc.
 * Estas funciones implementan la lógica de negocio (CRUD sobre estudiantes).
 */

require_once("./controllers/studentsController.php");

/**
 * Lee el método HTTP con el que se hizo la solicitud (por ejemplo GET, POST, PUT, etc).
 * PHP lo obtiene desde la variable global $_SERVER['REQUEST_METHOD'].
 */

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        handleGet($conn);
        break;
    case 'POST':
        handlePost($conn);
        break;
    case 'PUT':
        handlePut($conn);
        break;
    case 'DELETE':
        handleDelete($conn);
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}

//posible mejora: agregar una lógica (if) para detectar el módulo por parámetro GET o por URL "amigable"
/**
 * $module = $_GET['module'] ?? 'students';
 * if ($module === 'students') {
 *      require_once("./controllers/studentsController.php");
 *      // switch acá
 * } elseif ($module === 'teachers') {
 *      require_once("./controllers/teachersController.php");
 *      // otro switch
 * }

 * O usar un sistema de rutas tipo "router" más dinámico,
 * por ejemplo:
 * 
 * $method = $_SERVER['REQUEST_METHOD'];
 * $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
 * 
 * if ($path === '/api/students') {
 *      require_once("./controllers/studentsController.php");
 *      dispatchStudents($method, $conn);
 * }

 * este último método no lo entiendo.

 */
?>