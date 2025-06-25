<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre']);
    $usuario = trim($_POST['usuario']);
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $confirmar = $_POST['confirmar'];

    // Validación básica
    if (empty($nombre) || empty($usuario) || empty($correo) || empty($contrasena) || empty($confirmar)) {
        header("Location: ../login/register.php?error=Todos los campos son obligatorios");
        exit();
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login/register.php?error=Correo electrónico inválido");
        exit();
    }

    if ($contrasena !== $confirmar) {
        header("Location: ../login/register.php?error=Las contraseñas no coinciden");
        exit();
    }

    // Verificar duplicados
    $sql = "SELECT * FROM usuarios WHERE usuario = ? OR correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        header("Location: ../login/register.php?error=Usuario o correo ya registrados");
        exit();
    }

    // Insertar nuevo usuario
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $rol = 'usuario';

    $sql_insert = "INSERT INTO usuarios (nombre, usuario, correo, contrasena_hash, rol) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssss", $nombre, $usuario, $correo, $hash, $rol);

    if ($stmt_insert->execute()) {
        header("Location: ../login/login.php?mensaje=Cuenta creada correctamente");
        exit();
    } else {
        header("Location: ../login/register.php?error=Error al registrar");
        exit();
    }
} else {
    header("Location: ../login/register.php");
    exit();
}
