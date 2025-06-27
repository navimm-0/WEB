<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Vacante – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/admin.css">
</head>
<body>
    <header class="barra-superior">
        <div class="contenedor-header">
            <img src="../imagenes/logo.png" alt="GG Records" class="logo-header">
            <nav class="nav-header">
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
        <h1>Crear Nueva Vacante</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form method="POST" action="../scripts/procesar_vacante.php" class="formulario-vacante">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5" required></textarea>

            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" required>

            <label for="fecha_publicacion">Fecha de Publicación:</label>
            <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>

            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="date" id="fecha_cierre" name="fecha_cierre" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="activa" selected>Activa</option>
                <option value="inactiva">Inactiva</option>
            </select>

            <div class="acciones">
                <button type="submit" class="boton">Guardar</button>
                <a href="gestionar_vacantes.php" class="boton boton-secundario">Cancelar</a>
            </div>
        </form>
    </main>

    <footer class="pie-pagina">
        <?php include '../reuso/footer.php'; ?>
    </footer>
</body>
</html>
