<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitización de datos del formulario
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Criterios específicos
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
    if (empty($titulo) || empty($descripcion) || empty($criterio_1) || empty($criterio_2) ||
        $criterio_3 === '' || empty($criterio_4) || empty($criterio_5) || empty($criterio_6) ||
        empty($criterio_7) || empty($criterio_8) || $criterio_9 === '' || $criterio_10 === '' ||
        empty($criterio_11) || empty($criterio_12)) {
        header("Location: ../admin/crear_vacante.php?error=Faltan+campos+obligatorios");
        exit();
    }

    // Consulta preparada
    $sql = "INSERT INTO Vacante (
        titulo, descripcion,
        criterio_1, criterio_2, criterio_3, criterio_4, criterio_5, criterio_6,
        criterio_7, criterio_8, criterio_9, criterio_10, criterio_11, criterio_12
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error al preparar la consulta: " . $conn->error));
        exit();
    }

 $stmt->bind_param(
    "ssssssssssssss", // 14 letras 's' → 14 strings
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
    $criterio_12
);



    if ($stmt->execute()) {
        header("Location: ../admin/panel.php?exito=Vacante+creada+correctamente");
    } else {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error al guardar la vacante: " . $stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin/gestionar_vacantes.php");
    exit();
}
