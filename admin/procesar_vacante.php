<?php
session_start();
require_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
        header("Location: ../login/login.php");
        exit();
    }

    // Recoger y sanitizar datos
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $departamento = trim($_POST['departamento']);
    $palabras_clave = trim($_POST['palabras_clave']);
    $conocimientos = trim($_POST['conocimientos']);
    $sueldo = trim($_POST['sueldo']);
    $horario = trim($_POST['horario']);
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $estado = $_POST['estado'];

    // Validación básica
    if (
        empty($titulo) || empty($descripcion) || empty($departamento) || empty($conocimientos) ||
        empty($sueldo) || empty($horario) || empty($fecha_publicacion) || empty($fecha_cierre)
    ) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Todos los campos obligatorios deben llenarse"));
        exit();
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO Vacante (
                titulo, descripcion, departamento, palabras_clave, conocimientos,
                sueldo, horario, fecha_publicacion, fecha_cierre, estado
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssssss",
        $titulo, $descripcion, $departamento, $palabras_clave, $conocimientos,
        $sueldo, $horario, $fecha_publicacion, $fecha_cierre, $estado
    );

    if ($stmt->execute()) {
        header("Location: ../admin/vacantes.php");
        exit();
    } else {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error al guardar la vacante"));
        exit();
    }
} else {
    header("Location: ../admin/crear_vacante.php");
    exit();
}
