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

// Eliminar postulación si se solicita
if (isset($_GET['eliminar'])) {
    $id_postulacion = intval($_GET['eliminar']);
    $stmt = $conn->prepare("DELETE FROM postulaciones WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id_postulacion, $usuario_id);
    $stmt->execute();
    $stmt->close();
    header("Location: editar_soli.php");
    exit();
}

// Obtener todas las postulaciones del usuario
$stmt = $conn->prepare("
    SELECT p.id, v.titulo, p.fecha_postulacion, p.estado,
           p.telefono, p.direccion, p.horario_preferido, p.observaciones
    FROM postulaciones p
    JOIN Vacante v ON p.id_vacante = v.id
    WHERE p.id_usuario = ?
    ORDER BY p.fecha_postulacion DESC
");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Postulaciones – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/postulaciones.css">
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
            <a href="vacantes_disponibles.php">Vacantes</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-admin">
    <h1>Mis Postulaciones</h1>
    <div class="tarjetas-panel">
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <div class="tarjeta">
                <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($row['estado']); ?></p>
                <p><strong>Fecha:</strong> <?php echo htmlspecialchars($row['fecha_postulacion']); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($row['telefono']); ?></p>
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($row['direccion']); ?></p>
                <p><strong>Horario:</strong> <?php echo htmlspecialchars($row['horario_preferido']); ?></p>
                <p><strong>Observaciones:</strong> <?php echo nl2br(htmlspecialchars($row['observaciones'])); ?></p>

                <a href="editar_postulacion.php?id=<?php echo $row['id']; ?>" class="boton">✏️ Editar Datos</a>
                <a href="editar_soli.php?eliminar=<?php echo $row['id']; ?>" onclick="return confirm('¿Eliminar esta postulación?');" class="boton boton-secundario" style="margin-top: 1rem;">🗑 Eliminar</a>
            </div>
        <?php endwhile; ?>
    </div>
        <div style="text-align: center; margin-top: 2rem;">
        <a href="menu_usuario.php" class="boton-volver">🔙 Volver al Menú</a>
    </div>

</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
