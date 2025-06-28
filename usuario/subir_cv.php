<?php
session_start();
require_once("../scripts/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$id_vacante = $_POST['id_vacante'] ?? null;

// Obtener ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

if (!$usuario_id || !$id_vacante) {
    die("Error: datos incompletos.");
}

// Registrar la postulación (sin CV)
$stmt = $conn->prepare("INSERT INTO postulaciones (id_usuario, id_vacante, cv_pdf) VALUES (?, ?, NULL)");
$stmt->bind_param("ii", $usuario_id, $id_vacante);
$exito = $stmt->execute();
$stmt->close();

$mensaje = $exito ? "¡Postulación registrada correctamente!" : "Error al registrar la postulación.";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Postulación – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/vacantes.css">
</head>
<body class="index-body">
<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span><span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="menu_usuario.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h2><?php echo $mensaje; ?></h2>
    <a href="vacantes_disponibles.php" class="boton">Volver a vacantes</a>
</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
