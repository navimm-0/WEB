<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión exitoso – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/usuario.css">
    <style>
        body {
    background-color: #121212;
    color: #fff;
    font-family: 'Inter', sans-serif;
}
        .mensaje-bienvenida {
            background-color: #2b2b2b;
            padding: 3rem;
            border-radius: 20px;
            margin: 5rem auto;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 0 25px rgba(255,255,255,0.05);
        }

        .mensaje-bienvenida h2 {
            color: #fff;
            margin-bottom: 1rem;
        }

        .mensaje-bienvenida p {
            color: #ccc;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .btn-estado {
            background-color: #6d6d6d;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-estado:hover {
            background-color: #8c8c8c;
        }
        .btn-cerrar-sesion {
    background-color: #444;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-cerrar-sesion:hover {
    background-color: #666;
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
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div class="bienvenida">Hola, <?php echo htmlspecialchars($usuario); ?></div>
            <form action="../scripts/logout.php" method="POST">
                <button type="submit" class="btn-cerrar-sesion">Cerrar sesión</button>
            </form>
        </div>
    </div>
</header>

    <main>
        <div class="mensaje-bienvenida">
            <h2>Inicio de sesión exitoso</h2>
            <p>Bienvenido/a, <strong><?php echo htmlspecialchars($usuario); ?></strong>. Hemos encontrado tu solicitud de vacante.</p>
            <form action="menu_usuario.php" method="GET">
                <button type="submit" class="btn-estado">Ii al menu de usuario</button>
            </form>
        </div>
    </main>

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
                <li><a href="../login/login.php">Iniciar Sesión</a></li>
                <li><a href="../login/register.php">Registrarse</a></li>
                <li><a href="vacantes.php">Ver Vacantes</a></li>
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
</footer></body>
</html>
