<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $criterio_1 = trim($_POST['criterio_1'] ?? '');
    $criterio_2 = trim($_POST['criterio_2'] ?? '');
    $criterio_3 = isset($_POST['criterio_3']) && is_numeric($_POST['criterio_3']) ? intval($_POST['criterio_3']) : null;

    $criterio_4 = trim($_POST['criterio_4'] ?? '');
    $valores_validos_criterio_4 = ['Alto', 'Medio', 'Bajo'];
    if (!in_array($criterio_4, $valores_validos_criterio_4)) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Valor inválido para criterio_4."));
        exit();
    }

    $criterio_5 = trim($_POST['criterio_5'] ?? '');
    $criterio_6 = trim($_POST['criterio_6'] ?? '');
    $criterio_7 = trim($_POST['criterio_7'] ?? '');

    $criterio_8 = trim($_POST['criterio_8'] ?? '');
    $valores_si_no = ['Sí', 'No'];
    if (!in_array($criterio_8, $valores_si_no)) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Valor inválido para criterio_8."));
        exit();
    }

    $criterio_9 = isset($_POST['criterio_9']) && is_numeric($_POST['criterio_9']) ? intval($_POST['criterio_9']) : null;
    $criterio_10 = isset($_POST['criterio_10']) && is_numeric($_POST['criterio_10']) ? intval($_POST['criterio_10']) : null;

    $criterio_11 = trim($_POST['criterio_11'] ?? '');
    if (!in_array($criterio_11, $valores_si_no)) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Valor inválido para criterio_11."));
        exit();
    }

    $criterio_12 = trim($_POST['criterio_12'] ?? '');
    if (!in_array($criterio_12, $valores_si_no)) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Valor inválido para criterio_12."));
        exit();
    }

    if (
        empty($titulo) || empty($descripcion) ||
        empty($criterio_1) || empty($criterio_2) || $criterio_3 === null ||
        empty($criterio_4) || empty($criterio_5) || empty($criterio_6) || empty($criterio_7) ||
        empty($criterio_8) || $criterio_9 === null || $criterio_10 === null ||
        empty($criterio_11) || empty($criterio_12)
    ) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Faltan campos obligatorios."));
        exit();
    }

    $sql = "INSERT INTO Vacante (
        titulo, descripcion,
        criterio_1, criterio_2, criterio_3, criterio_4, criterio_5, criterio_6,
        criterio_7, criterio_8, criterio_9, criterio_10, criterio_11, criterio_12
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error al preparar: " . $conn->error));
        exit();
    }

    // Tipos: s = string, i = integer
    $stmt->bind_param("sssissssssiiss", 
        $titulo, $descripcion, $criterio_1, $criterio_2, $criterio_3,
        $criterio_4, $criterio_5, $criterio_6, $criterio_7, $criterio_8,
        $criterio_9, $criterio_10, $criterio_11, $criterio_12
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
