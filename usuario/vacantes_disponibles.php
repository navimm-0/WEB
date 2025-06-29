<?php
session_start();
require_once("../scripts/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

$id_usuario = $_SESSION['id'];

// Obtener todas las vacantes activas y si el usuario ya aplicó
$sql = "
    SELECT V.*, 
           EXISTS (
               SELECT 1 FROM postulaciones P 
               WHERE P.id_usuario = ? AND P.id_vacante = V.id
           ) AS ya_postulado
    FROM Vacante V
    WHERE V.estado = 'activa'
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
            <a href="editar_soli.php">Postulaciones</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
  <h1>Vacantes Disponibles</h1>

  <a href="menu_usuario.php" class="boton boton-volver">🔙 Volver</a>

  <div class="tarjetas-usuario">
    <?php if ($resultado->num_rows > 0): ?>
        <?php while($fila = $resultado->fetch_assoc()): ?>
            <div class="tarjeta-opcion">
                <h3><?= htmlspecialchars($fila['titulo']) ?></h3>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                <p><strong>Sueldo mensual:</strong> $<?= number_format($fila['criterio_10'], 2) ?></p>

                <?php if ($fila['ya_postulado']): ?>
                    <div class="tooltip">
                        <button class="boton deshabilitado" disabled>Postulado</button>
                        <span class="tooltip-text">✅ Ya te postulaste</span>
                    </div>
                <?php else: ?>
                    <form action="formulario_aplicacion.php" method="POST">
                        <input type="hidden" name="id_vacante" value="<?= $fila['id'] ?>">
                        <button type="submit" class="boton">Aplicar</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay vacantes disponibles en este momento.</p>
    <?php endif; ?>
  </div>
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
