<?php
require_once("scripts/verificar_sesion.php");
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
<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="login/login.php">Iniciar sesión</a>
            <a href="login/register.php">Registro</a>
            <a href="usuario/vacantes.php">Vacantes</a>
        </nav>
    </div>
</header>


<body class="index-body">
    <div class="contenedor-index grande efecto">
        <img src="imagenes/logo.png" alt="GG Records" class="logo">
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
            <a href="login/login.php" class="boton grande">Iniciar Sesión</a>
            <a href="login/register.php" class="boton boton-secundario grande">Registrarse</a>
        </div>
    </div>
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
                    <li><a href="../login/login.php">Iniciar Sesión</a></li>
                    <li><a href="../login/register.php">Registrarse</a></li>
                    <li><a href="../usuario/vacantes.php">Ver Vacantes</a></li>
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