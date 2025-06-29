<?php
session_start();
require_once("../scripts/conexion.php");

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../login/login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_vacante = $_POST['id_vacante'] ?? null;

if (!$id_vacante || !is_numeric($id_vacante)) {
    die("Vacante no válida.");
}

// ✅ Verificar si ya se postuló
$stmt = $conn->prepare("SELECT 1 FROM postulaciones WHERE id_usuario = ? AND id_vacante = ?");
$stmt->bind_param("ii", $id_usuario, $id_vacante);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    // Ya se postuló, bloquear acceso
    echo "<script>alert('⚠️ Ya te has postulado a esta vacante.'); window.location.href = 'vacantes_disponibles.php';</script>";
    exit();
}
$stmt->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicar a Vacante</title>
    <link rel="stylesheet" href="../estilos/formulario.css">
</head>
<body>
    <h1>Formulario de Aplicación</h1>

    <form id="formulario" method="POST" action="../scripts/procesar_aplicacion.php">
        <input type="hidden" name="id_vacante" value="<?= htmlspecialchars($id_vacante) ?>">

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" maxlength="20" required>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" maxlength="100" required>

        <label for="horario">Horario preferido:</label>
        <select name="horario" id="horario" required>
            <option value="">Selecciona una opción</option>
            <option value="matutino">Matutino</option>
            <option value="vespertino">Vespertino</option>
            <option value="mixto">Mixto</option>
        </select>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" rows="4" required></textarea>

        <label for="cv_texto">Pega el contenido de tu CV:</label>
        <textarea name="cv_texto" id="cv_texto" rows="10" required></textarea>

        <button type="button" onclick="mostrarConfirmacion()">Enviar postulación</button>
        <a href="vacantes_disponibles.php" class="boton-volver">🔙 Volver</a>

    </form>

    <!-- Modal -->
    <div id="modalConfirmacion" class="modal">
        <div class="modal-contenido">
            <h2>Confirmar postulación</h2>
            <p>¿Estás seguro de que deseas enviar esta postulación?</p>
            <button onclick="enviarFormulario()">Sí, enviar</button>
            <button onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>

    <script>
        function mostrarConfirmacion() {
            document.getElementById('modalConfirmacion').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modalConfirmacion').style.display = 'none';
        }

        function enviarFormulario() {
            document.getElementById('formulario').submit();
        }

        // Cierra modal si se hace clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('modalConfirmacion');
            if (event.target == modal) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>
