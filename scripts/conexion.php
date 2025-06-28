<?php
$host = "148.204.57.65";         // IP del servidor remoto
$port = 3306;                    // Puerto MySQL (no SFTP)
$db   = "2025proyjtw";
$user = "202501gtw";
$pass = "2025#01067";

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

echo "✅ Conexión establecida correctamente a '$db'";

?>
