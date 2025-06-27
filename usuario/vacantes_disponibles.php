<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vacantes Disponibles – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/usuario.css">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Inter', sans-serif;
        }

        .vacantes-container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .vacantes-container h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #ccc;
        }

        .area-nombre {
            font-size: 1.3rem;
            color: #9be2ff;
            margin: 2rem 0 1rem;
        }

        .grid-vacantes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .tarjeta-vacante {
            background-color: #1f1f1f;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(255,255,255,0.05);
            transition: transform 0.2s ease;
        }

        .tarjeta-vacante:hover {
            transform: scale(1.03);
            background-color: #292929;
        }

        .tarjeta-vacante h3 {
            margin-top: 0;
            color: #fff;
        }

        .tarjeta-vacante p {
            margin: 0.5rem 0;
            color: #bbb;
            font-size: 0.9rem;
        }

        .btn-aplicar {
            margin-top: 1rem;
            padding: 0.6rem 1.2rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-aplicar:hover {
            background-color: #0056b3;
        }
    </style>
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
            <a href="../scripts/logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main class="vacantes-container">
    <h1>Vacantes Disponibles</h1>

    <div class="area-nombre">Área: Producción Musical</div>
    <div class="grid-vacantes">
        <div class="tarjeta-vacante">
            <h3>Productor Musical</h3>
            <p>Horario: Lunes a Viernes, 10am - 6pm</p>
            <p>Descripción: Encargado de la producción técnica y artística de los proyectos musicales.</p>
            <button class="btn-aplicar">Aplicar</button>
        </div>
    </div>

    <div class="area-nombre">Área: Sonido</div>
    <div class="grid-vacantes">
        <div class="tarjeta-vacante">
            <h3>Técnico de Sonido</h3>
            <p>Horario: Turnos rotativos, disponibilidad fines de semana</p>
            <p>Descripción: Configuración y control del audio en estudios y eventos en vivo.</p>
            <button class="btn-aplicar">Aplicar</button>
        </div>
    </div>

    <div class="area-nombre">Área: Artística</div>
    <div class="grid-vacantes">
        <div class="tarjeta-vacante">
            <h3>Músico</h3>
            <p>Horario: Según calendario de eventos</p>
            <p>Descripción: Participación en grabaciones, ensayos y presentaciones en vivo.</p>
            <button class="btn-aplicar">Aplicar</button>
        </div>
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
