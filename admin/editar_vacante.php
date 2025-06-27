<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once '../scripts/conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: gestionar_vacantes.php");
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM Vacante WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    header("Location: gestionar_vacantes.php?error=Vacante no encontrada");
    exit();
}

$vacante = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vacante – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/gestionar_vacantes.css">
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
    <h1>Editar Vacante</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="../scripts/actualizar_vacante.php" class="formulario-vacante">
        <input type="hidden" name="id" value="<?php echo $vacante['id']; ?>">

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($vacante['titulo']); ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($vacante['descripcion']); ?></textarea>

        <?php for ($i = 1; $i <= 12; $i++): ?>
            <label for="criterio_<?php echo $i; ?>">Criterio <?php echo $i; ?>:</label>
            <input type="text" id="criterio_<?php echo $i; ?>" name="criterio_<?php echo $i; ?>" 
                   value="<?php echo htmlspecialchars($vacante["criterio_$i"]); ?>">
        <?php endfor; ?>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="activa" <?php if ($vacante['estado'] === 'activa') echo 'selected'; ?>>Activa</option>
            <option value="inactiva" <?php if ($vacante['estado'] === 'inactiva') echo 'selected'; ?>>Inactiva</option>
        </select>

        <td class="acciones">
    <a href="editar_vacante.php?id=<?php echo $fila['id']; ?>" class="boton">Editar</a>
    <form method="POST" action="../scripts/eliminar_vacante.php" onsubmit="return confirm('¿Estás seguro de eliminar esta vacante?')">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
        <button type="submit" class="boton boton-secundario">Eliminar</button>
    </form>
</td>

    </form>
</main>

<footer class="pie-pagina">
    <?php include '../reuso/footer.php'; ?>
</footer>

</body>
</html>
