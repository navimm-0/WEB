<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitización de datos recibidos
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $departamento = trim($_POST['departamento'] ?? '');
    $palabras_clave = trim($_POST['palabras_clave'] ?? '');
    $conocimientos = trim($_POST['conocimientos'] ?? '');
    $sueldo = trim($_POST['sueldo'] ?? '');
    $horario = trim($_POST['horario'] ?? '');
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? '';
    $fecha_cierre = $_POST['fecha_cierre'] ?? '';
    $estado = $_POST['estado'] ?? 'activa';

    // Validación básica
    if (
        empty($titulo) || empty($descripcion) || empty($departamento) || empty($conocimientos) ||
        empty($sueldo) || empty($horario) || empty($fecha_publicacion) || empty($fecha_cierre)
    ) {
        header("Location: ../admin/crear_vacante.php?error=Faltan campos obligatorios");
        exit();
    }

    // Consulta preparada
    $sql = "INSERT INTO Vacante (
        titulo, descripcion, departamento, palabras_clave, conocimientos, sueldo,
        horario, fecha_publicacion, fecha_cierre, estado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssssss",
        $titulo,
        $descripcion,
        $departamento,
        $palabras_clave,
        $conocimientos,
        $sueldo,
        $horario,
        $fecha_publicacion,
        $fecha_cierre,
        $estado
    );

    if ($stmt->execute()) {
        header("Location: ../admin/crear_vacante.php?exito=Vacante guardada correctamente");
    } else {
        header("Location: ../admin/crear_vacante.php?error=Error al guardar la vacante: " . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin/crear_vacante.php");
    exit();
}
