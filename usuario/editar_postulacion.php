<?php
session_start();
require_once("../scripts/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Obtener ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

// Validar ID de postulación
$id_postulacion = $_GET['id'] ?? null;
if (!$id_postulacion || !is_numeric($id_postulacion)) {
    die("ID de postulación no válido.");
}

// Obtener los datos actuales de la postulación
$stmt = $conn->prepare("SELECT telefono, direccion, horario_preferido, observaciones FROM postulaciones WHERE id = ? AND id_usuario = ?");
$stmt->bind_param("ii", $id_postulacion, $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows === 0) {
    die("Postulación no encontrada.");
}
$datos = $resultado->fetch_assoc();
$stmt->close();

// Procesar actualización
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $telefono = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $horario = $_POST['horario'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';

    $stmt = $conn->prepare("UPDATE postulaciones SET telefono = ?, direccion = ?, horario_preferido = ?, observaciones = ? WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ssssii", $telefono, $direccion, $horario, $observaciones, $id_postulacion, $usuario_id);
    $stmt->execute();
    $stmt->close();

    header("Location: editar_soli.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Postulación – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/editar_postulacion.css">
</head>
<body>
<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="menu_usuario.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-admin">
    <h1>Editar Postulación</h1>
    <form method="POST">
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($datos['telefono']) ?>" required>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($datos['direccion']) ?>" required>

        <label for="horario">Horario preferido:</label>
        <select name="horario" id="horario" required>
            <option value="" disabled>Selecciona una opción</option>
            <option value="matutino" <?= $datos['horario_preferido'] === 'matutino' ? 'selected' : '' ?>>Matutino</option>
            <option value="vespertino" <?= $datos['horario_preferido'] === 'vespertino' ? 'selected' : '' ?>>Vespertino</option>
            <option value="mixto" <?= $datos['horario_preferido'] === 'mixto' ? 'selected' : '' ?>>Mixto</option>
        </select>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" rows="4" required><?= htmlspecialchars($datos['observaciones']) ?></textarea>

        <button type="submit" class="boton">Guardar Cambios</button>
    </form>
        <div style="text-align: center; margin-top: 2rem;">
        <a href="editar_soli.php" class="boton-volver">🔙 Volver a Mis Postulaciones</a>
    </div>

</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
