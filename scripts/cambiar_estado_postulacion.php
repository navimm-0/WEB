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

    if ($accion === 'aceptar') {
        $nuevo_estado = 'aceptada';
    } elseif ($accion === 'rechazar') {
        $nuevo_estado = 'rechazada';
    } else {
        header("Location: ../admin/postulaciones_admin.php");
        exit();
    }

    $sql = "UPDATE postulaciones SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevo_estado, $id);

    $stmt->execute();
    header("Location: ../admin/postulaciones_admin.php");
    exit();
}
?>
