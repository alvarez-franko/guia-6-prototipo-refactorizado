<?php

/**
 * Este archivo configura y establece una conexión con la base de
 * datos MySQL usando la extensión MySQLi (MySQL Improved). Es
 * fundamental en cualquier aplicación que use datos
 * persistentes. Este archivo puede cambiar en producción (por
 * ejemplo, al usar un servidor externo o variables de entorno).

 */

$host = "localhost";
$user = "students_user";
$password = "12345";
$database = "students_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["error" => "Database connection failed"]));
}

/**
 * Este chequeo evita que el backend siga funcionando sin
 * acceso a la base de datos, lo cual sería peligroso y
 * podría causar errores encadenados.

 */
?>