<?php
require_once("../scripts/verificar_sesion.php");

if ($_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once("../scripts/conexion.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: gestionar_vacantes.php");
    exit();
}

$id = intval($_GET['id']);

$sql_delete = "DELETE FROM vacantes WHERE id = ?";
$stmt = $conn->prepare($sql_delete);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: gestionar_vacantes.php?mensaje=Vacante eliminada");
    exit();
} else {
    header("Location: gestionar_vacantes.php?error=Error al eliminar vacante");
    exit();
}
