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
    <title>Menú del Usuario – GG Records</title>
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
            <a href="../index.php">Inicio</a>
            <a href="menu.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

    <div class="opciones-usuario">
        <a href="vacantes_disponibles.php" class="tarjeta-opcion">
            <h2>📌 Seleccionar Vacante</h2>
            <p>Explora vacantes e inscríbete.</p>
        </a>

        <a href="mis_registros.php" class="tarjeta-opcion">
            <h2>📋 Ver Registros</h2>
            <p>Revisa tus vacantes solicitadas.</p>
        </a>

        <a href="editar_soli.php" class="tarjeta-opcion">
            <h2>✏️ Editar Solicitudes</h2>
            <p>Modifica o cancela tus solicitudes.</p>
        </a>
    </div>
</main>

<footer class="pie-pagina">
    <div class="footer-contenido">
        <div class="footer-col">
            <h4>GG Records</h4>
            <p>Distribuidora nacional de productos musicales.</p>
        </div>
        <div class="footer-col">
            <h4>Contacto</h4>
            <p>Email: contacto@ggrecords.com</p>
            <p>Tel: +52 55 1234 5678</p>
        </div>
        <div class="footer-col">
            <h4>Síguenos</h4>
            <div class="redes-sociales">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
