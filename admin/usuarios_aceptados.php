<?php
session_start();
require_once '../scripts/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$sql = "
    SELECT 
        u.nombre AS nombre_usuario,
        u.usuario AS username,
        v.titulo AS titulo_vacante,
        p.fecha_postulacion
    FROM postulaciones p
    INNER JOIN usuarios u ON p.id_usuario = u.id
    INNER JOIN Vacante v ON p.id_vacante = v.id
    WHERE p.estado = 'aceptada'
    ORDER BY p.fecha_postulacion DESC
";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Aceptados – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/usuarios_aceptados.css">
</head>
<body>

<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="panel.php">Panel</a>
            <a href="postulaciones.php">Postulaciones</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-admin">
    <h1>Usuarios Aceptados</h1>

    <div class="acciones-admin">
        <a href="panel.php" class="boton-volver">🔙 Volver al Panel</a>
    </div>

    <?php if ($resultado->num_rows > 0): ?>
        <table class="tabla-aceptados">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Vacante</th>
                    <th>Fecha de Aceptación</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre_usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['titulo_vacante']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_postulacion']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="mensaje-vacio">No hay usuarios aceptados aún.</p>
    <?php endif; ?>
</main>

<footer class="pie-pagina">
    <div class="footer-contenido">
        <div class="footer-col">
            <h4>GG Records</h4>
            <p>Distribuidora nacional de productos musicales.</p>
        </div>
        <div class="footer-col">
            <h4>Contacto</h4>
            <p>Email: contacto@ggrecords.com</p>
            <p>Tel: +52 55 1234 5678</p>
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
