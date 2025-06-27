<?php
require_once("../scripts/verificar_sesion.php");

if ($_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once("../scripts/conexion.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: gestionar_vacantes.php");
    exit();
}

$id = intval($_GET['id']);
$error = "";

// Obtener datos actuales de la vacante
$sql = "SELECT * FROM vacantes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: gestionar_vacantes.php");
    exit();
}

$vacante = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $departamento = trim($_POST['departamento']);
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $estado = $_POST['estado'];

    // Validación básica
    if (!$titulo || !$descripcion || !$departamento || !$fecha_publicacion || !$fecha_cierre || !$estado) {
        $error = "Por favor completa todos los campos.";
    } else {
        $sql_update = "UPDATE vacantes SET titulo = ?, descripcion = ?, departamento = ?, fecha_publicacion = ?, fecha_cierre = ?, estado = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssi", $titulo, $descripcion, $departamento, $fecha_publicacion, $fecha_cierre, $estado, $id);

        if ($stmt_update->execute()) {
            header("Location: gestionar_vacantes.php");
            exit();
        } else {
            $error = "Error al actualizar la vacante.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vacante – GG Records</title>
    <link rel="stylesheet" href="../estilos/admin.css">
</head>
<body>
    <main class="contenido-admin">
        <h1>Editar Vacante</h1>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="editar_vacante.php?id=<?php echo $id; ?>">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($vacante['titulo']); ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5" required><?php echo htmlspecialchars($vacante['descripcion']); ?></textarea>

            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" value="<?php echo htmlspecialchars($vacante['departamento']); ?>" required>

            <label for="fecha_publicacion">Fecha de Publicación:</label>
            <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="<?php echo $vacante['fecha_publicacion']; ?>" required>

            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="date" id="fecha_cierre" name="fecha_cierre" value="<?php echo $vacante['fecha_cierre']; ?>" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="activa" <?php if ($vacante['estado'] === 'activa') echo "selected"; ?>>Activa</option>
                <option value="inactiva" <?php if ($vacante['estado'] === 'inactiva') echo "selected"; ?>>Inactiva</option>
            </select>

            <button type="submit" class="boton">Actualizar</button>
            <a href="gestionar_vacantes.php" class="boton">Cancelar</a>
        </form>
    </main>
</body>
</html>
