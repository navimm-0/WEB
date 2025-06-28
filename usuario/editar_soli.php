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

// Actualizar CV si se envió uno nuevo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_postulacion']) && isset($_FILES['cv'])) {
    $id_postulacion = intval($_POST['id_postulacion']);
    $cv = $_FILES['cv'];

    if ($cv['error'] === 0 && pathinfo($cv['name'], PATHINFO_EXTENSION) === 'pdf' && $cv['type'] === 'application/pdf') {
        $nombreNuevoCV = uniqid("cv_", true) . ".pdf";
        $rutaDestino = "../uploads/" . $nombreNuevoCV;
        move_uploaded_file($cv['tmp_name'], $rutaDestino);

        $stmt = $conn->prepare("UPDATE postulaciones SET cv_pdf = ? WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("sii", $nombreNuevoCV, $id_postulacion, $usuario_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Obtener todas las postulaciones del usuario
$stmt = $conn->prepare("
    SELECT p.id, v.titulo, p.fecha_postulacion, p.estado, p.cv_pdf
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
    <link rel="stylesheet" href="../estilos/menu_usuario.css">
</head>
<body>
<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="menu.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h2>Mis Postulaciones</h2>
    <div class="tarjetas-usuario">
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <div class="tarjeta-opcion" style="font-size: 0.9rem;">
                <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($row['estado']); ?></p>
                <p><strong>Fecha:</strong> <?php echo htmlspecialchars($row['fecha_postulacion']); ?></p>
                <p><a href="../uploads/<?php echo htmlspecialchars($row['cv_pdf']); ?>" target="_blank">📄 Ver CV</a></p>

                <form method="POST" enctype="multipart/form-data" style="margin-top:1rem;">
                    <input type="hidden" name="id_postulacion" value="<?php echo $row['id']; ?>">
                    <input type="file" name="cv" accept="application/pdf" required>
                    <button type="submit">Actualizar CV</button>
                </form>

                <a href="editar_soli.php?eliminar=<?php echo $row['id']; ?>" onclick="return confirm('¿Eliminar esta postulación?');" style="color:red; display:block; margin-top:0.5rem;">🗑 Eliminar</a>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
