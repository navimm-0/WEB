<?php
$host = "localhost";
$db = "ggrecords";
$user = "root";
$pass = ""; // sin contraseña

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
