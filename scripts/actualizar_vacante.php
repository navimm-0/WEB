<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $departamento = trim($_POST['departamento']);
    $palabras_clave = trim($_POST['palabras_clave']);
    $conocimientos = trim($_POST['conocimientos']);
    $sueldo = trim($_POST['sueldo']);

    // Validación básica
    if (empty($titulo) || empty($descripcion) || empty($departamento) || empty($conocimientos) || empty($sueldo)) {
        header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("Todos los campos obligatorios deben llenarse"));
        exit();
    }

    // Actualización
    $sql = "UPDATE Vacante 
            SET titulo = ?, descripcion = ?, departamento = ?, palabras_clave = ?, conocimientos = ?, sueldo = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $titulo, $descripcion, $departamento, $palabras_clave, $conocimientos, $sueldo, $id);

    if ($stmt->execute()) {
        header("Location: ../admin/gestionar_vacantes.php?exito=Vacante actualizada correctamente");
    } else {
        header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("Error al actualizar la vacante"));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin/gestionar_vacantes.php");
    exit();
}
