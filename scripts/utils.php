<?php
function actualizarDatosSesion($conn) {
    if (isset($_SESSION['id_usuario'])) {
        $sql = "SELECT usuario, rol FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['id_usuario']);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($fila = $res->fetch_assoc()) {
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['rol'] = $fila['rol'];
        }
    }
}
?>
