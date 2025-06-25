<?php
session_start();
if (isset($_SESSION['rol'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión – GG Records</title>
  <link rel="stylesheet" href="../reuso/header.css">
  <link rel="stylesheet" href="../reuso/footer.css">
  <link rel="stylesheet" href="../estilos/login.css">
</head>
<body>
 <header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="register.php">Registro</a>
            <a href="../usuario/vacantes.php">Vacantes</a>
        </nav>
    </div>
</header>

  <main class="contenedor-login">
    <form action="../scripts/procesar_login.php" method="POST" class="formulario-login">
      <h2>Iniciar Sesión</h2>

      <label for="usuario">Usuario:</label>
      <input type="text" name="usuario" required>

      <label for="contrasena">Contraseña:</label>
      <input type="password" name="contrasena" required>

      <button type="submit">Entrar</button>

      <?php if (isset($_GET['error'])): ?>
        <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
      <?php endif; ?>
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
