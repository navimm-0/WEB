session_start();

if (isset($_SESSION['rol'])) {
    $ruta_actual = $_SERVER['PHP_SELF'];

    if ($_SESSION['rol'] === 'admin' && !str_contains($ruta_actual, 'admin/panel.php')) {
        header('Location: ../admin/panel.php');
        exit();
    } elseif ($_SESSION['rol'] === 'usuario' && !str_contains($ruta_actual, 'usuario/vacantes.php')) {
        header('Location: ../usuario/vacantes.php');
        exit();
    }
}
