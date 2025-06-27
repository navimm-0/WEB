<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("conexion.php");
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $contrasena_actual = $_POST['contrasena_actual'] ?? '';
    $contrasena_nueva = $_POST['contrasena_nueva'] ?? '';
    $confirmar_contrasena = $_POST['confirmar_contrasena'] ?? '';

    // Validar campos obligatorios
    if (empty($nombre) || empty($correo) || empty($usuario) || empty($contrasena_actual)) {
        header("Location: ../usuario/perfil.php?error=Todos los campos obligatorios deben estar llenos");
        exit();
    }

    // Confirmar nueva contraseña si se proporcionó
    if (!empty($contrasena_nueva) && $contrasena_nueva !== $confirmar_contrasena) {
        header("Location: ../usuario/perfil.php?error=La nueva contraseña no coincide con la confirmación");
        exit();
    }

    // Verificar contraseña actual
    $sql = "SELECT contrasena_hash FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($hash_guardado);
    if (!$stmt->fetch()) {
        header("Location: ../usuario/perfil.php?error=Usuario no encontrado");
        exit();
    }
    $stmt->close();

    if (!password_verify($contrasena_actual, $hash_guardado)) {
        header("Location: ../usuario/perfil.php?error=Contraseña actual incorrecta");
        exit();
    }

    // Armar consulta según si se desea cambiar la contraseña
    if (!empty($contrasena_nueva)) {
        $nuevo_hash = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombre = ?, correo = ?, contrasena_hash = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $correo, $nuevo_hash, $id);
    } else {
        $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $correo, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../usuario/perfil.php?exito=Perfil actualizado correctamente");
    } else {
        header("Location: ../usuario/perfil.php?error=" . urlencode("Error al actualizar: " . $stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../usuario/perfil.php");
    exit();
}
