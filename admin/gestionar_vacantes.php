<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
require_once '../scripts/conexion.php';

// Obtener vacantes
$sql = "SELECT * FROM Vacante ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Vacantes - GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/ver_vacantes.css">
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
        <h1>Vacantes Publicadas</h1>

        <div class="acciones">
            <a href="panel.php" class="boton boton-volver">Volver al Panel</a>
        </div>

        <table class="tabla-vacantes">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Criterio Principal</th>
                    <th>Estado</th>
                    <th>Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($fila['criterio_1']); ?></td>
                            <td><?php echo ucfirst($fila['estado'] ?? 'desconocido'); ?></td>
                            <td><?php echo htmlspecialchars($fila['fecha_creacion']); ?></td>
                            <td class="acciones">
                                <a href="editar_vacante.php?id=<?php echo $fila['id']; ?>" class="boton">Editar</a>
                                <form method="POST" action="../scripts/eliminar_vacante.php"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta vacante?')">
                                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                    <button type="submit" class="boton boton-secundario">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="mensaje-info">Actualmente no hay vacantes registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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