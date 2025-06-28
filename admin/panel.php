<?php
session_start();

// Verificar acceso solo para administradores
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Administrador – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/admin.css">
</head>

<body>
   <?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 ?>
<header class="barra-superior" style="font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;">
    <div class="contenedor-header">
        <!-- Logotipo textual al estilo del index -->
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
                <a href="../index.php">Inicio</a>
                <a href="gestionar_vacantes.php">Vacantes</a>
                <a href="postulaciones.php">Postulaciones</a>
                <a href="dada.php">Aceptados</a>
                <a href="perfil.php">Perfil</a>
                <a href="../scripts/logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="../login/login.php">Iniciar sesión</a>
                <a href="../login/register.php">Registro</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

    <main class="contenido-admin">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Desde aquí puedes gestionar las vacantes, postulaciones y empleados de GG Records.</p>

        <section class="tarjetas-panel">
            <div class="tarjeta">
                <h3>Crear vacantes</h3>
                <p>Crear o modificar vacantes internas.</p>
                <a href="crear_vacante.php" class="boton">Crear</a>
            </div>
            <div class="tarjeta">
                <h3>Postulaciones</h3>
                <p>Revisa quién ha aplicado a las vacantes.</p>
                <a href="postulaciones_admin.php" class="boton">Ver Postulaciones</a>
            </div>
            <div class="tarjeta">
                <h3>Usuarios aceptados</h3>
                <p>Administra el listado los aplicantes aceptados.</p>
                <a href="usuarios_aceptados.php" class="boton">Ver</a>
            </div>
             <div class="tarjeta">
                <h3>Gestionar vacantes</h3>
                <p>Administra las vacantes publicadas.</p>
                <a href="gestionar_vacantes.php" class="boton">Gestionar</a>
            </div>
        </section>
    </main>

    <footer class="pie-pagina">
        <div class="footer-contenido">
            <div class="footer-col">
                <h4>GG Records</h4>
                <p>Distribuidora nacional de productos musicales. Conectamos talento, tecnología y pasión por la música.
                </p>
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