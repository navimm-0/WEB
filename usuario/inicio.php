<?php
require_once("../scripts/verificar_sesion.php");

// Redirigir si no es usuario
if ($_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Usuario – GG Records</title>
    <link rel="stylesheet" href="../estilos/principal.css">
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/usuario.css">
</head>
<body>

<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <span>Hola, <?php echo htmlspecialchars($nombreUsuario); ?></span>
            <a href="../scripts/logout.php">Cerrar sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h1>Bienvenido al Panel del Usuario</h1>
    <div class="tarjetas-usuario">
        <a href="vacantes.php" class="tarjeta-opcion">
            <h2>Vacantes Disponibles</h2>
            <p>Consulta y postúlate a vacantes internas.</p>
        </a>
        <a href="mis_postulaciones.php" class="tarjeta-opcion">
            <h2>Mis Postulaciones</h2>
            <p>Revisa el estado de tus solicitudes.</p>
        </a>
        <a href="perfil.php" class="tarjeta-opcion">
            <h2>Mi Perfil</h2>
            <p>Consulta o edita tus datos personales.</p>
        </a>
    </div>
</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
