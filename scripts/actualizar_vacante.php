<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    $criterio_1 = $_POST['criterio_1'] ?? '';
    $criterio_2 = $_POST['criterio_2'] ?? '';
    $criterio_3 = $_POST['criterio_3'] ?? '';
    $criterio_4 = $_POST['criterio_4'] ?? '';
    $criterio_5 = $_POST['criterio_5'] ?? '';
    $criterio_6 = $_POST['criterio_6'] ?? '';
    $criterio_7 = $_POST['criterio_7'] ?? '';
    $criterio_8 = $_POST['criterio_8'] ?? '';
    $criterio_9 = $_POST['criterio_9'] ?? '';
    $criterio_10 = $_POST['criterio_10'] ?? '';
    $criterio_11 = $_POST['criterio_11'] ?? '';
    $criterio_12 = $_POST['criterio_12'] ?? '';

    // Validación básica
    if (
        empty($titulo) || empty($descripcion) || empty($criterio_1) || empty($criterio_2) ||
        $criterio_3 === '' || empty($criterio_4) || empty($criterio_5) || empty($criterio_6) ||
        empty($criterio_7) || empty($criterio_8) || $criterio_9 === '' || $criterio_10 === '' ||
        empty($criterio_11) || empty($criterio_12)
    ) {
        header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("Todos los campos obligatorios deben llenarse"));
        exit();
    }

    // Actualización SQL
    $sql = "UPDATE Vacante SET 
        titulo = ?, descripcion = ?, 
        criterio_1 = ?, criterio_2 = ?, criterio_3 = ?, criterio_4 = ?, criterio_5 = ?, criterio_6 = ?,
        criterio_7 = ?, criterio_8 = ?, criterio_9 = ?, criterio_10 = ?, criterio_11 = ?, criterio_12 = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
    "ssssssssssssssi", // 14 strings + 1 int
    $titulo,
    $descripcion,
    $criterio_1,
    $criterio_2,
    $criterio_3,
    $criterio_4,
    $criterio_5,
    $criterio_6,
    $criterio_7,
    $criterio_8,
    $criterio_9,
    $criterio_10,
    $criterio_11,
    $criterio_12,
    $id
);


    if ($stmt->execute()) {
        header("Location: ../admin/gestionar_vacantes.php?exito=Vacante actualizada correctamente");
    } else {
        header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("Error al actualizar la vacante: " . $stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin/gestionar_vacantes.php");
    exit();
}
