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
                    
                </span>
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

        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" value="<?php echo htmlspecialchars($vacante['departamento']); ?>" required>

        <label for="palabras_clave">Palabras Clave (solo admin):</label>
        <textarea id="palabras_clave" name="palabras_clave" rows="2"><?php echo htmlspecialchars($vacante['palabras_clave']); ?></textarea>

        <label for="conocimientos">Conocimientos requeridos:</label>
        <textarea id="conocimientos" name="conocimientos" rows="3" required><?php echo htmlspecialchars($vacante['conocimientos']); ?></textarea>

        <label for="sueldo">Sueldo:</label>
        <input type="text" id="sueldo" name="sueldo" value="<?php echo htmlspecialchars($vacante['sueldo']); ?>" required>

        <div class="acciones">
            <button type="submit" class="boton">Actualizar Vacante</button>
            <a href="gestionar_vacantes.php" class="boton boton-secundario"> Volver</a>
        </div>
    </form>
</main>

<footer class="pie-pagina">
    <?php include '../reuso/footer.php'; ?>
</footer>

</body>
</html>
