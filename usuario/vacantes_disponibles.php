<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../scripts/conexion.php');

$sql = "SELECT * FROM Vacante WHERE estado = 'activa' ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vacantes Disponibles – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/vacantes.css">
</head>
<body>

<header class="barra-superior" style="font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span><span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="../index.php">Inicio</a>
            <a href="menu_usuario.php">Menú Usuario</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h1>Vacantes Disponibles</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <div class="vacantes-lista">
            <?php while ($fila = $resultado->fetch_assoc()): ?>
               <!-- ...dentro del while ($fila = $resultado->fetch_assoc()) -->
<div class="vacante-card">
    <h2><?php echo htmlspecialchars($fila['titulo']); ?></h2>
    <p><?php echo htmlspecialchars($fila['descripcion']); ?></p>
    <ul>
        <li><strong>Nivel académico:</strong> <?php echo htmlspecialchars($fila['criterio_1']); ?></li>
        <li><strong>Software requerido:</strong> <?php echo htmlspecialchars($fila['criterio_2']); ?></li>
        <li><strong>Años de experiencia:</strong> <?php echo htmlspecialchars($fila['criterio_3']); ?></li>
        <li><strong>Edad mínima:</strong> <?php echo htmlspecialchars($fila['criterio_9']); ?></li>
        <li><strong>Sueldo mensual:</strong> $<?php echo number_format($fila['criterio_10'], 2); ?> MXN</li>
    </ul>
    <a href="aplicar_vacante.php?id=<?php echo $fila['id']; ?>" class="boton">Aplicar</a>
</div>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay vacantes disponibles en este momento.</p>
    <?php endif; ?>
</main>

<footer class="pie-pagina">
    <?php include '../reuso/footer.php'; ?>
</footer>

</body>
</html>
