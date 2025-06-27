<?php
require_once("../scripts/verificar_sesion.php");

// Validar rol admin
if ($_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once("../scripts/conexion.php");

// Obtener vacantes
$sql = "SELECT * FROM vacantes ORDER BY fecha_publicacion DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Vacantes – GG Records</title>
    <link rel="stylesheet" href="../estilos/admin.css">
    <link rel="stylesheet" href="reuso/header.css">
</head>

<body>
    <?php
    session_start();
    ?>

    <header class="barra-superior">
    <div class="contenedor-header">
        <img src="../imagenes/logo.png" alt="GG Records" class="logo-header">
        <nav class="nav-header">
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="bienvenida">
                    Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                    (<?php echo htmlspecialchars($_SESSION['rol']); ?>)
                </span>
                <a href="panel.php">Inicio</a>
                <a href="vacantes.php">Vacantes</a>
                <a href="postulaciones.php">Postulaciones</a>
                <a href="empleados.php">Empleados</a>
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
        <h1>Gestionar Vacantes</h1>
        <a href="crear_vacante.php" class="boton">Nueva Vacante</a>

        <div class="tarjetas-panel">
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($vacante = $resultado->fetch_assoc()): ?>
                    <div class="tarjeta">
                        <h3><?php echo htmlspecialchars($vacante['titulo']); ?></h3>
                        <p><strong>Departamento:</strong> <?php echo htmlspecialchars($vacante['departamento']); ?></p>
                        <p><strong>Publicada:</strong> <?php echo $vacante['fecha_publicacion']; ?></p>
                        <p><strong>Cierre:</strong> <?php echo $vacante['fecha_cierre']; ?></p>
                        <p><strong>Estado:</strong> <?php echo ucfirst($vacante['estado']); ?></p>
                        <a href="editar_vacante.php?id=<?php echo $vacante['id']; ?>" class="boton">Editar</a>
                        <a href="eliminar_vacante.php?id=<?php echo $vacante['id']; ?>" class="boton"
                            onclick="return confirm('¿Eliminar esta vacante?');">Eliminar</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay vacantes registradas.</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>