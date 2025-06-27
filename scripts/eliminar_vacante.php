<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM Vacante WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Eliminación exitosa: redirigir a la vista de gestión
        header("Location: ../admin/gestionar_vacantes.php?eliminado=1");
        exit();
    } else {
        // Error al eliminar
        header("Location: ../admin/gestionar_vacantes.php?error=1");
        exit();
    }
} else {
    // Acceso inválido
    header("Location: ../admin/gestionar_vacantes.php");
    exit();
}
?>
