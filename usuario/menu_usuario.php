<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Usuario – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/menu_usuario.css">
</head>
<body>
<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span><span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="../index.php">Inicio</a>
            <a href="menu_usuario.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

    <section class="tarjetas-menu">
        <a href="inscribir_vacante.php" class="tarjeta-opcion">
            <h2>📌 Seleccionar Vacante</h2>
            <p>Explora vacantes disponibles y postúlate.</p>
        </a>

        <a href="ver_postulaciones.php" class="tarjeta-opcion">
            <h2>📋 Ver Registros</h2>
            <p>Consulta tus vacantes solicitadas y su estado.</p>
        </a>

        <a href="editar_postulaciones.php" class="tarjeta-opcion">
            <h2>✏️ Editar Solicitudes</h2>
            <p>Modifica o retira tus postulaciones actuales.</p>
        </a>
    </section>
</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
