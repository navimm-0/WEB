<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("conexion.php");

    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $departamento = trim($_POST['departamento']);
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $estado = $_POST['estado'];

    if (!$titulo || !$descripcion || !$departamento || !$fecha_publicacion || !$fecha_cierre || !$estado) {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Completa todos los campos."));
        exit();
    }

    $sql = "INSERT INTO vacantes (titulo, descripcion, departamento, fecha_publicacion, fecha_cierre, estado)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", $titulo, $descripcion, $departamento, $fecha_publicacion, $fecha_cierre, $estado);
        if ($stmt->execute()) {
            header("Location: ../admin/gestionar_vacantes.php");
            exit();
        } else {
            header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error al guardar."));
            exit();
        }
    } else {
        header("Location: ../admin/crear_vacante.php?error=" . urlencode("Error en la base de datos."));
        exit();
    }
} else {
    header("Location: ../admin/crear_vacante.php");
    exit();
}
