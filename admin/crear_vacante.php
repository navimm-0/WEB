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
        <h1>Crear Nueva Vacante</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <main class="contenido-admin">
            <h1>Crear Nueva Vacante Musical</h1>

          <form method="POST" action="../scripts/procesar_vacante.php" autocomplete="off">
    <label for="titulo">Título de la vacante:</label>
    <input type="text" id="titulo" name="titulo" maxlength="25" required>

    <label for="descripcion">Descripción del puesto:</label>
    <textarea id="descripcion" name="descripcion" rows="4" maxlength="500" required></textarea>

    <h3>Perfil requerido para el candidato ideal</h3>

    <label for="criterio_1">Nivel académico solicitado:</label>
    <select id="criterio_1" name="criterio_1" required>
        <option value="">-- Selecciona --</option>
        <option value="Técnico">Técnico</option>
        <option value="Licenciatura">Licenciatura</option>
        <option value="Maestría">Maestría</option>
        <option value="Sin requisito">Sin requisito</option>
    </select>

    <label for="criterio_2">Software de producción requerido:</label>
    <select id="criterio_2" name="criterio_2" required>
        <option value="">-- Selecciona --</option>
        <option value="Ableton Live">Ableton Live</option>
        <option value="FL Studio">FL Studio</option>
        <option value="Logic Pro">Logic Pro</option>
        <option value="Pro Tools">Pro Tools</option>
        <option value="Otro">Otro</option>
    </select>

    <label for="criterio_3">Años mínimos de experiencia en producción musical:</label>
    <input type="number" id="criterio_3" name="criterio_3" min="0" required>

    <label for="criterio_4">Nivel de experiencia en mezcla y masterización:</label>
    <select id="criterio_4" name="criterio_4" required>
        <option value="">-- Selecciona --</option>
        <option value="Alto">Alto</option>
        <option value="Medio">Medio</option>
        <option value="Bajo">Bajo</option>
    </select>

    <label for="criterio_5">Conocimiento en teoría musical:</label>
    <select id="criterio_5" name="criterio_5" required>
        <option value="">-- Selecciona --</option>
        <option value="Avanzado">Avanzado</option>
        <option value="Intermedio">Intermedio</option>
        <option value="Básico">Básico</option>
    </select>

    <label for="criterio_6">Nivel de inglés técnico musical requerido:</label>
    <select id="criterio_6" name="criterio_6" required>
        <option value="">-- Selecciona --</option>
        <option value="Avanzado">Avanzado</option>
        <option value="Intermedio">Intermedio</option>
        <option value="Básico">Básico</option>
    </select>

    <label for="criterio_7">Instrumento preferente que domine:</label>
    <select id="criterio_7" name="criterio_7" required>
        <option value="">-- Selecciona --</option>
        <option value="Guitarra">Guitarra</option>
        <option value="Piano/Teclado">Piano/Teclado</option>
        <option value="Batería">Batería</option>
        <option value="Voz">Voz</option>
        <option value="Otro">Otro</option>
        <option value="Ninguno">Ninguno</option>
    </select>

    <label for="criterio_8">Disponibilidad para presentaciones nocturnas:</label>
    <select id="criterio_8" name="criterio_8" required>
        <option value="">-- Selecciona --</option>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <label for="criterio_9">Edad mínima requerida:</label>
    <input type="number" id="criterio_9" name="criterio_9" min="16" required>

    <label for="criterio_10">Sueldo ofertado mensual (MXN):</label>
    <input type="number" id="criterio_10" name="criterio_10" min="0" required>

    <label for="criterio_11">Disponibilidad para giras:</label>
    <select id="criterio_11" name="criterio_11" required>
        <option value="">-- Selecciona --</option>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <label for="criterio_12">Conocimiento deseado en edición de audio/video:</label>
    <select id="criterio_12" name="criterio_12" required>
        <option value="">-- Selecciona --</option>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <div class="acciones">
        <button type="submit" class="boton">Guardar Vacante</button>
        <a href="panel.php" class="boton boton-secundario">Cancelar</a>
    </div>
</form>

        </main>



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