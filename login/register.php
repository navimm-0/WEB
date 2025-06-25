<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro – GG Records</title>
    <link rel="stylesheet" href="../estilos/register.css">
</head>
<body>
    <div class="registro-contenedor">
        <h2>Crear una cuenta</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <form action="../scripts/procesar_registro.php" method="POST">
            <label for="nombre">Nombre completo:</label>
            <input type="text" name="nombre" required>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required>

            <label for="correo">Correo electrónico:</label>
            <input type="email" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>

            <label for="confirmar">Confirmar contraseña:</label>
            <input type="password" name="confirmar" required>

            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
    </div>
</body>
</html>
