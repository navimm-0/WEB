<?php
session_start();
require_once("../scripts/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Obtener ID de vacante (desde POST inicial o POST del envío de archivo)
$id_vacante = $_POST['id_vacante'] ?? null;

// Obtener ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

if (!$usuario_id || !$id_vacante) {
    die("Error: datos incompletos.");
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["cv"])) {
    if ($_FILES["cv"]["error"] === 0) {
        $nombreArchivo = $_FILES["cv"]["name"];
        $tipoArchivo = $_FILES["cv"]["type"];
        $tmpArchivo = $_FILES["cv"]["tmp_name"];

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if (strtolower($extension) !== "pdf" || $tipoArchivo !== "application/pdf") {
            $mensaje = "Error: Solo se permiten archivos PDF.";
        } else {
            $carpetaDestino = "../uploads/";
            if (!is_dir($carpetaDestino)) {
                mkdir($carpetaDestino, 0777, true);
            }

            $nombreSeguro = uniqid("cv_", true) . ".pdf";
            $rutaFinal = $carpetaDestino . $nombreSeguro;

            if (move_uploaded_file($tmpArchivo, $rutaFinal)) {
$stmt = $conn->prepare("INSERT INTO postulaciones (id_usuario, id_vacante, cv_pdf) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $usuario_id, $id_vacante, $nombreSeguro);
                $stmt->execute();
                $stmt->close();

                $mensaje = "¡CV subido exitosamente!";
            } else {
                $mensaje = "Error al guardar el archivo.";
            }
        }
    } else {
        $mensaje = "Selecciona un archivo válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir CV - GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/subir_cv.css">

</head>
<body>
<header class="barra-superior">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span>
            <span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="menu.php">Menú</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
    <h2>Sube tu CV para la vacante #<?php echo htmlspecialchars($id_vacante); ?></h2>
    <?php if ($mensaje): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>

    <form action="subir_cv.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_vacante" value="<?php echo htmlspecialchars($id_vacante); ?>">
        <label for="cv">Selecciona tu CV (PDF):</label><br><br>
        <input type="file" name="cv" id="cv" accept="application/pdf" required><br><br>
        <button type="submit">Subir CV</button>
    </form>
</main>

<footer class="pie-pagina">
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>