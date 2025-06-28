<?php
session_start();
require_once("../scripts/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

$id_usuario = $_SESSION['id'];

// Vacantes activas en las que el usuario NO se ha inscrito aún
$sql = "
    SELECT V.* 
    FROM Vacante V
    WHERE V.estado = 'activa' 
    AND NOT EXISTS (
        SELECT 1 FROM postulaciones P 
        WHERE P.id_usuario = ? AND P.id_vacante = V.id
    )
    ORDER BY V.fecha_creacion DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
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
<body class="index-body">

<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="menu_usuario.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
  <h1>Vacantes Disponibles</h1>
  <div class="tarjetas-usuario">
    <?php if ($resultado->num_rows > 0): ?>
        <?php while($fila = $resultado->fetch_assoc()): ?>
            <div class="tarjeta-opcion">
                <h3><?= htmlspecialchars($fila['titulo']) ?></h3>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                <p><strong>Sueldo mensual:</strong> $<?= number_format($fila['criterio_10'], 2) ?></p>
                <!-- Enlace en lugar de formulario -->
                <a href="subir_cv.php?id_vacante=<?= $fila['id'] ?>" class="boton">Aplicar</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay vacantes disponibles en este momento o ya aplicaste a todas.</p>
    <?php endif; ?>
  </div>
</main>

<footer class="pie-pagina">
    <div class="footer-contenido"></div>
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
