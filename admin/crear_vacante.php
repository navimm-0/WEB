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
  <title>Crear Vacante - GG Records</title>
  <link rel="stylesheet" href="../reuso/header.css">
  <link rel="stylesheet" href="../reuso/footer.css">
  <link rel="stylesheet" href="../estilos/crear_vacante.css">
</head>
<body>
 <header class="barra-superior" style="font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <?php if (isset($_SESSION['usuario'])): ?>
                    
                </span>
                <a href="../index.php">Inicio</a>
                <a href="panel.php">Panel Administrador</a>
                <a href="vacantes.php">Vacantes</a>
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
    <h1>Crear Nueva Vacante</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="../scripts/procesar_vacante.php" class="formulario-vacante">
        <label for="titulo">Título de la vacante:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descripcion">Descripción general:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

        <label for="departamento">Área o departamento:</label>
        <input type="text" id="departamento" name="departamento" required>

        <label for="palabras_clave">Palabras clave (solo visibles para administrador):</label>
        <textarea id="palabras_clave" name="palabras_clave" rows="3" placeholder="Ejemplo: producción, mezcla, sampleos"></textarea>

        <label for="conocimientos">Conocimientos requeridos:</label>
        <textarea id="conocimientos" name="conocimientos" rows="3" required></textarea>

        <label for="sueldo">Sueldo aproximado:</label>
        <input type="text" id="sueldo" name="sueldo" required>

        <label for="horario">Horario de trabajo:</label>
        <input type="text" id="horario" name="horario" required>

        <label for="fecha_publicacion">Fecha de publicación:</label>
        <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>

        <label for="fecha_cierre">Fecha de cierre:</label>
        <input type="date" id="fecha_cierre" name="fecha_cierre" required>

        <label for="estado">Disponibilidad:</label>
        <select id="estado" name="estado" required>
            <option value="activa" selected>Activa</option>
            <option value="inactiva">Inactiva</option>
        </select>

        <div class="acciones">
            <button type="submit" class="boton">Guardar Vacante</button>
            <a href="panel.php" class="boton boton-secundario">Cancelar</a>
        </div>
    </form>
</main>


  <footer class="pie-pagina">
    <?php include '../reuso/footer.php'; ?>
  </footer>
</body>
</html>
