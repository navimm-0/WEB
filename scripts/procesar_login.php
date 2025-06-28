<?php
session_start();
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    if (empty($usuario) || empty($contrasena)) {
        header("Location: ../login/login.php?error=" . urlencode("Todos los campos son obligatorios"));
        exit();
    }

    // 🔍 Validar contra base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();

        if (password_verify($contrasena, $fila['contrasena_hash'])) {
            $_SESSION['id_usuario'] = $fila['id'];
            $_SESSION['rol'] = $fila['rol'];
            $_SESSION['usuario'] = $fila['usuario'];

            if ($fila['rol'] === 'admin') {
                header("Location: ../admin/panel.php");
                exit();
            } else {
                header("Location: ../usuario/bienvenida.php");
                exit();
            }
        } else {
            header("Location: ../login/login.php?error=" . urlencode("Contraseña incorrecta"));
            exit();
        }
    } else {
        header("Location: ../login/login.php?error=" . urlencode("Usuario no encontrado"));
        exit();
    }
} else {
    header("Location: ../login/login.php");
    exit();
}
