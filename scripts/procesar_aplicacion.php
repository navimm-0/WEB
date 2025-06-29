<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("conexion.php");

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../login/login.php?error=Acceso no autorizado");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_vacante = $_POST['id_vacante'] ?? null;
$telefono = trim($_POST['telefono'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$horario = $_POST['horario'] ?? '';
$observaciones = trim($_POST['observaciones'] ?? '');
$cv_texto = trim($_POST['cv_texto'] ?? '');

if (!$id_vacante || !$telefono || !$direccion || !$horario || empty($cv_texto)) {
    die("Faltan campos obligatorios.");
}

$check = $conn->prepare("SELECT 1 FROM postulaciones WHERE id_usuario = ? AND id_vacante = ?");
$check->bind_param("ii", $id_usuario, $id_vacante);
$check->execute();
$check->store_result();
if ($check->num_rows > 0) {
    die("Ya te postulaste a esta vacante.");
}

$palabras_clave = ['liderazgo', 'responsable', 'comunicación', 'proactivo', 'trabajo en equipo'];
$coincidencias = 0;
foreach ($palabras_clave as $palabra) {
    if (stripos($cv_texto, $palabra) !== false) {
        $coincidencias++;
    }
}
$puntaje_cv = round(($coincidencias / count($palabras_clave)) * 100, 2);

$stmt = $conn->prepare("
    INSERT INTO postulaciones 
    (id_usuario, id_vacante, estado, observaciones, puntaje_cv, telefono, direccion, horario_preferido) 
    VALUES (?, ?, 'pendiente', ?, ?, ?, ?, ?)
");
$stmt->bind_param("iisdsss", $id_usuario, $id_vacante, $observaciones, $puntaje_cv, $telefono, $direccion, $horario);

if ($stmt->execute()) {
    header("Location: ../usuario/menu_usuario.php?success=1");
    exit();
} else {
    echo "Error al guardar la postulación: " . $stmt->error;
}
?>
