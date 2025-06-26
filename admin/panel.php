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
    <header class="barra-superior">
        <div class="contenedor-header">
            <img src="../imagenes/logo.png" alt="GG Records" class="logo-header">
            <nav>
                <a href="panel.php">Inicio</a>
                <a href="vacantes.php">Vacantes</a>
                <a href="postulaciones.php">Postulaciones</a>
                <a href="empleados.php">Empleados</a>
                <a href="perfil.php">Perfil</a>
                <a href="../scripts/logout.php">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <main class="contenido-admin">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Desde aquí puedes gestionar las vacantes, postulaciones y empleados de GG Records.</p>

        <section class="tarjetas-panel">
            <div class="tarjeta">
                <h3>Vacantes</h3>
                <p>Crear o modificar vacantes internas</p>
                <a href="vacantes.php" class="boton">Gestionar</a>
            </div>
            <div class="tarjeta">
                <h3>Postulaciones</h3>
                <p>Revisa quién ha aplicado a las vacantes</p>
                <a href="postulaciones.php" class="boton">Ver Postulaciones</a>
            </div>
            <div class="tarjeta">
                <h3>Empleados</h3>
                <p>Administra el listado de empleados  contratados</p>
                <a href="empleados.php" class="boton">Ver Emple ados</a>
            </div>
        </section>
    </main>

    <footer class="pie-pagina">
        <?php include '../reuso/footer.php'; ?>
    </footer>
</body>
</html>
