<?php

/**
 * Este archivo se encarga de recibir, procesar y responder las solicitudes HTTP.
 * 
 * Es parte del patrón MVC (Modelo - Vista - Controlador), donde:
 * ● Los Modelos acceden a los datos (models/students.php).
 * ● Los Controladores procesan las peticiones y devuelven
 * respuestas.
 * ● Las Vistas en este caso están en el frontend JavaScript.
 */

 
//importa las funcions del modelo students.php
require_once("./models/students.php");

//si el metodo es get, y recibe una id, se devuelve solo ese estudiante. Sino, se devuelve toda la lista.
function handleGet($conn) {
    if (isset($_GET['id'])) {
        $result = getStudentById($conn, $_GET['id']);
        echo json_encode($result->fetch_assoc());
    } else {
        $result = getAllStudents($conn);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
}

//crea estudiante
function handlePost($conn) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (createStudent($conn, $input['fullname'], $input['email'], $input['age'])) {
        echo json_encode(["message" => "Estudiante agregado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo agregar"]);
    }
}

//edita estudiante
function handlePut($conn) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (updateStudent($conn, $input['id'], $input['fullname'], $input['email'], $input['age'])) {
        echo json_encode(["message" => "Actualizado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo actualizar"]);
    }
}

//elimina estudiante
function handleDelete($conn) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (deleteStudent($conn, $input['id'])) {
        echo json_encode(["message" => "Eliminado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo eliminar"]);
    }
}

//falta validar datos de entrada
//falta "sanitizacion" para prevenir errores y vulnerabilidades
//falta un sistema de logging de errores.
//falta "reutilizar  lógica de json_decode(file_get_contents(...)) en una función común"

?>