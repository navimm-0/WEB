<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_postulacion'])) {
    $id_postulacion = intval($_POST['id_postulacion']);

    $sql = "DELETE FROM postulaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_postulacion);

    if ($stmt->execute()) {
        header("Location: ../admin/postulaciones_admin.php");
    } else {
        echo "Error al eliminar la postulación.";
    }
}
?>
