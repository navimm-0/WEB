<?php
session_start();
require_once("conexion.php");

// Verifica que el usuario sea administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);

    // Recolectar criterios
    $criterios = [];
    for ($i = 1; $i <= 12; $i++) {
        $criterios[$i] = $_POST["criterio_$i"] ?? '';
    }

    // Validación básica
    if (empty($titulo) || empty($descripcion)) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Todos los campos son obligatorios."));
        exit();
    }

    // Insertar la vacante en la base de datos
    $sql = "INSERT INTO Vacante (
        titulo, descripcion,
        criterio_1, criterio_2, criterio_3, criterio_4,
        criterio_5, criterio_6, criterio_7, criterio_8,
        criterio_9, criterio_10, criterio_11, criterio_12
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssisssssiiis",
        $titulo, $descripcion,
        $criterios[1], $criterios[2], $criterios[3], $criterios[4],
        $criterios[5], $criterios[6], $criterios[7], $criterios[8],
        $criterios[9], $criterios[10], $criterios[11], $criterios[12]
    );

    if ($stmt->execute()) {
        header("Location: ../admin/panel.php");
        exit();
    } else {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error al guardar la vacante."));
        exit();
    }
} else {
    header("Location: ../admin/crear_vacante.php");
    exit();
}
