<?php
$host = "148.204.57.65";
$db = "2025proygtw";
$user = "202501gtw";
$pass = "2025#01067"; // sin contraseña

$conn = new mysql($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
