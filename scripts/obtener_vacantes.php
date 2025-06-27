<?php
require_once("conexion.php");

$sql = "SELECT * FROM Vacante ORDER BY fecha_publicacion DESC";
$resultado = $conn->query($sql);

$vacantes = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $vacantes[] = $fila;
    }
}
