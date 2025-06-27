<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once '../scripts/conexion.php';

$usuario = $_SESSION['usuario'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/perfil_admin.css">
</head>

<body>

    <header class="barra-superior">
        <div class="contenedor-header">
            <div class="logo-area">
                <span class="gg">GG</span>
                <span class="records">RECORDS</span>
            </div>
            <nav class="nav-header">
                <a href="../index.php">Inicio</a>
                <a href="panel.php">Panel</a>
                <a href="perfil.php">Perfil</a>
                <a href="../scripts/logout.php">Cerrar Sesión</a>
            </nav>
        </div>
    </header>
    <?php if (isset($_GET['exito'])): ?>
        <div class="exito"><?php echo htmlspecialchars($_GET['exito']); ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <main class="contenido-admin">
        <h1>Mi Perfil</h1>
        <form method="POST" action="../scripts/actualizar_admin.php" class="formulario-vacante">
            <input type="hidden" name="id" value="<?php echo $datos['id'] ?? ''; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($datos['nombre'] ?? ''); ?>"
                required>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo"
                value="<?php echo htmlspecialchars($datos['correo'] ?? ''); ?>" required>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario"
                value="<?php echo htmlspecialchars($datos['usuario'] ?? ''); ?>" readonly>

            <label for="contrasena_actual">Contraseña actual:</label>
            <input type="password" name="contrasena_actual" id="contrasena_actual" required>

            <label for="contrasena_nueva">Nueva contraseña (opcional):</label>
            <input type="password" name="contrasena_nueva" id="contrasena_nueva">

            <label for="confirmar_contrasena">Confirmar nueva contraseña:</label>
            <input type="password" name="confirmar_contrasena" id="confirmar_contrasena">

            <div class="acciones">
                <button type="submit" class="boton">Actualizar Perfil</button>
                <a href="panel.php" class="boton boton-secundario">Cancelar</a>
            </div>
        </form>


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