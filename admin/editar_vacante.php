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

    <label for="titulo">Título de la Vacante:</label>
    <input type="text" id="titulo" name="titulo" maxlength="25"
           value="<?php echo htmlspecialchars($vacante['titulo']); ?>" required>

    <label for="descripcion">Descripción del Puesto:</label>
    <textarea id="descripcion" name="descripcion" rows="4" maxlength="500" required><?php echo htmlspecialchars($vacante['descripcion']); ?></textarea>

    <h3>Perfil requerido para el candidato ideal</h3>
    <p>Establece el nivel esperado en cada una de las siguientes competencias musicales y técnicas:</p>

    <?php
    $criterios_nombres = [
        1 => "Composición musical",
        2 => "Arreglos y estructura de canciones",
        3 => "Conocimiento de teoría musical",
        4 => "Manejo de DAW",
        5 => "Grabación de audio",
        6 => "Edición y mezcla",
        7 => "Masterización",
        8 => "Uso de instrumentos virtuales y plugins",
        9 => "Trabajo colaborativo en sesiones",
        10 => "Creatividad en producción",
        11 => "Gestión del tiempo en entregas",
        12 => "Adaptabilidad a estilos musicales"
    ];

    $opciones = ['-- Seleccionar --', 'Alto', 'Medio', 'Bajo'];

    for ($i = 1; $i <= 12; $i++):
        $nombre = "criterio_$i";
        $valor_actual = htmlspecialchars($vacante[$nombre]);
    ?>
        <label for="<?php echo $nombre; ?>">
            Nivel requerido en "<?php echo $criterios_nombres[$i]; ?>":
        </label>
        <select id="<?php echo $nombre; ?>" name="<?php echo $nombre; ?>">
            <?php foreach ($opciones as $op): ?>
                <option value="<?php echo $op === '-- Seleccionar --' ? '' : $op; ?>" <?php if ($valor_actual === $op) echo 'selected'; ?>>
                    <?php echo $op; ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php endfor; ?>

    <label for="estado">Estado de la Vacante:</label>
    <select id="estado" name="estado" required>
        <option value="activa" <?php if ($vacante['estado'] === 'activa') echo 'selected'; ?>>Activa</option>
        <option value="inactiva" <?php if ($vacante['estado'] === 'inactiva') echo 'selected'; ?>>Inactiva</option>
    </select>

    <div class="acciones">
        <button type="submit" class="boton">Actualizar Vacante</button>
        <a href="gestionar_vacantes.php" class="boton boton-secundario">Volver</a>
    </div>
</form>

</main>

<footer class="pie-pagina">
    <?php include '../reuso/footer.php'; ?>
</footer>

</body>
</html>
