<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id_postulacion']);
    $accion = $_POST['accion'];

    // Obtener el id_usuario relacionado con esta postulación
    $consulta = "SELECT id_usuario FROM postulaciones WHERE id = ?";
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id_usuario);
    $stmt->fetch();
    $stmt->close();

    if ($accion === 'aceptar') {
        // 1. Cambiar el estado a 'aceptada'
        $sql = "UPDATE postulaciones SET estado = 'aceptada' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // 2. Eliminar todas las demás postulaciones de ese usuario
        $sql_delete = "DELETE FROM postulaciones WHERE id_usuario = ? AND id != ?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("ii", $id_usuario, $id);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion === 'rechazar') {
        // Cambiar el estado a 'rechazada'
        $sql = "UPDATE postulaciones SET estado = 'rechazada' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ../admin/postulaciones.php");
    exit();
}
?>
