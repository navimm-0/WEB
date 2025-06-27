<?php
session_start(); // Iniciamos la sesión para poder acceder a $_SESSION
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GG Records – Bienvenido</title>
    <link rel="stylesheet" href="estilos/principal.css">
    <link rel="stylesheet" href="reuso/footer.css">
    <link rel="stylesheet" href="reuso/header.css">
</head>

<body class="index-body">
    <header class="barra-superior">
        <div class="contenedor-header">
            <div class="logo-area">
                <span class="gg">GG</span>
                <span class="records">RECORDS</span>
            </div>
            <nav class="nav-header">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <span class="bienvenida">
                        Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                        (<?php echo htmlspecialchars($_SESSION['rol']); ?>)
                    </span>
                    <?php if ($_SESSION['rol'] === 'admin'): ?>
                        <a href="admin/panel.php">Panel</a>
                    <?php else: ?>
                        <a href="usuario/vacantes.php">Vacantes</a>
                    <?php endif; ?>
                    <a href="scripts/logout.php">Cerrar sesión</a>
                <?php else: ?>
                    <a href="login/login.php">Iniciar sesión</a>
                    <a href="login/register.php">Registro</a>
                    <a href="usuario/vacantes.php">Vacantes</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <div class="contenedor-index grande efecto">
        <h1 class="titulo-principal">Únete a GG Records</h1>
        <p class="descripcion">
            Somos una empresa líder en la <strong>distribución de productos musicales</strong>, comprometida con llevar
            la música a cada rincón del mundo.
        </p>
        <p class="descripcion">
            Este portal es exclusivo para gestionar nuestras <strong>vacantes internas</strong>. Aquí podrás postularte,
            dar seguimiento a tu solicitud y formar parte de un equipo apasionado por el ritmo y la innovación.
        </p>

        <div class="botones">
            <?php if (!isset($_SESSION['usuario'])): ?>
                <a href="login/login.php" class="boton grande">Iniciar Sesión</a>
                <a href="login/register.php" class="boton boton-secundario grande">Registrarse</a>
            <?php else: ?>
                <?php if ($_SESSION['rol'] === 'admin'): ?>
                    <a href="admin/panel.php" class="boton grande">Ir al Panel</a>
                <?php else: ?>
                    <a href="usuario/menu_usuario.php" class="boton grande">Ir al Panel</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer class="pie-pagina">
        <div class="footer-contenido">
            <div class="footer-col">
                <h4>GG Records</h4>
                <p>Distribuidora nacional de productos musicales. Conectamos talento, tecnología y pasión por la música.</p>
            </div>

            <div class="footer-col">
                <h4>Contacto</h4>
                <p>Email: contacto@ggrecords.com</p>
                <p>Tel: +52 55 1234 5678</p>
                <p>Ubicación: Ciudad de México</p>
            </div>

            <div class="footer-col">
                <h4>Enlaces útiles</h4>
                <ul>
                    <?php if (!isset($_SESSION['usuario'])): ?>
                        <li><a href="login/login.php">Iniciar Sesión</a></li>
                        <li><a href="login/register.php">Registrarse</a></li>
                    <?php endif; ?>
                    <li><a href="usuario/vacantes.php">Ver Vacantes</a></li>
                </ul>
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
