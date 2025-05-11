<?php

//funciones de acceso a base de datos

function getAllStudents($conn) {
    $sql = "SELECT * FROM students";
    return $conn->query($sql);
}

/**
 * ¿Por qué usar prepare() y bind_param()?
 * Porque estamos usando un valor proporcionado por el usuario
 * ($id).
 * ● Previene ataques de inyección SQL.
 * ● "i" indica que el parámetro es de tipo integer.
 */

function getStudentById($conn, $id) {
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function createStudent($conn, $fullname, $email, $age) {
    $sql = "INSERT INTO students (fullname, email, age) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fullname, $email, $age);
    return $stmt->execute();
}

function updateStudent($conn, $id, $fullname, $email, $age) {
    $sql = "UPDATE students SET fullname = ?, email = ?, age = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $fullname, $email, $age, $id);
    return $stmt->execute();
}

function deleteStudent($conn, $id) {
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

/**
 * ¿Cómo lo evita prepare()?
 * Cuando usamos prepare() y bind_param(), el SQL y los datos se
 * envían separados al servidor.
 * $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
 * $stmt->bind_param("i", $id); // "i" = integer
 * $stmt->execute();
 * Lo importante:
 * ● El ? es un marcador de posición, no se sustituye por
 * exto.
 * ● bind_param() asegura que el valor sea del tipo esperado
 * (entero en este caso).
 * ● Si alguien pone 1 OR 1=1, ese texto se interpretará como
 * una cadena de texto, no como código SQL.

 */

?>