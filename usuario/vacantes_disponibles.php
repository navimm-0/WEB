<?php
session_start();
require_once("../scripts/conexion.php");

// Verifica que el usuario haya iniciado sesión como usuario
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

// Obtener vacantes activas
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
                <h3><?php echo htmlspecialchars($fila['titulo']); ?></h3>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($fila['descripcion']); ?></p>
                <p><strong>Sueldo mensual:</strong> $<?php echo number_format($fila['criterio_10'], 2); ?></p>
                <form action="postularse.php" method="POST">
                    <input type="hidden" name="id_vacante" value="<?php echo $fila['id']; ?>">
                    <button type="submit" class="boton">Aplicar</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay vacantes disponibles en este momento.</p>
    <?php endif; ?>
  </div>
</main>

<footer class="pie-pagina">
    <div class="footer-contenido">
        <!-- contenido footer aquí -->
    </div>
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
