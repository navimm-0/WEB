<?php
require_once("../scripts/verificar_sesion.php");

if ($_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../scripts/conexion.php");

    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $departamento = trim($_POST['departamento']);
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $estado = $_POST['estado'];

    // Validaciones básicas
    if (!$titulo || !$descripcion || !$departamento || !$fecha_publicacion || !$fecha_cierre || !$estado) {
        $error = "Por favor completa todos los campos.";
    } else {
        $sql = "INSERT INTO vacantes (titulo, descripcion, departamento, fecha_publicacion, fecha_cierre, estado) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $titulo, $descripcion, $departamento, $fecha_publicacion, $fecha_cierre, $estado);

        if ($stmt->execute()) {
            header("Location: gestionar_vacantes.php");
            exit();
        } else {
            $error = "Error al guardar la vacante.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Vacante – GG Records</title>
    <link rel="stylesheet" href="../estilos/admin.css">
</head>
<body>
    <main class="contenido-admin">
        <h1>Crear Nueva Vacante</h1>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="crear_vacante.php">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5" required></textarea>

            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" required>

            <label for="fecha_publicacion">Fecha de Publicación:</label>
            <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>

            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="date" id="fecha_cierre" name="fecha_cierre" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="activa" selected>Activa</option>
                <option value="inactiva">Inactiva</option>
            </select>

            <button type="submit" class="boton">Guardar</button>
            <a href="gestionar_vacantes.php" class="boton">Cancelar</a>
        </form>
    </main>
</body>
</html>
