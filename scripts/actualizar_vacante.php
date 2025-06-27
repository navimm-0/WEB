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

    // Recolectar criterios
    $criterios = [];
    for ($i = 1; $i <= 12; $i++) {
        $key = "criterio_$i";
        $criterios[$key] = trim($_POST[$key] ?? '');
    }

    // Validar campos obligatorios vacíos
    if (empty($titulo) || empty($descripcion) || in_array('', $criterios, true)) {
        header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("Todos los campos obligatorios deben llenarse"));
        exit();
    }

    // Validar longitudes
    if (strlen($titulo) > 100 || strlen($descripcion) > 500) {
        header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("Título o descripción exceden el tamaño permitido"));
        exit();
    }

    foreach ($criterios as $k => $v) {
        if (strlen($v) > 100) {
            header("Location: ../admin/editar_vacante.php?id=$id&error=" . urlencode("El $k excede el tamaño permitido (100 caracteres)"));
            exit();
        }
    }

    // Consulta preparada
    $sql = "UPDATE Vacante SET 
        titulo = ?, descripcion = ?, 
        criterio_1 = ?, criterio_2 = ?, criterio_3 = ?, criterio_4 = ?, criterio_5 = ?, criterio_6 = ?,
        criterio_7 = ?, criterio_8 = ?, criterio_9 = ?, criterio_10 = ?, criterio_11 = ?, criterio_12 = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssssi",
        $titulo,
        $descripcion,
        $criterios['criterio_1'],
        $criterios['criterio_2'],
        $criterios['criterio_3'],
        $criterios['criterio_4'],
        $criterios['criterio_5'],
        $criterios['criterio_6'],
        $criterios['criterio_7'],
        $criterios['criterio_8'],
        $criterios['criterio_9'],
        $criterios['criterio_10'],
        $criterios['criterio_11'],
        $criterios['criterio_12'],
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
