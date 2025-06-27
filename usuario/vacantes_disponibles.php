<?php
session_start();
require_once("../scripts/conexion.php");

// Verifica que el usuario haya iniciado sesión como usuario
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

// Obtener vacantes
$sql = "SELECT * FROM Vacante ORDER BY titulo ASC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Vacantes Disponibles – GG Records</title>
  <link rel="stylesheet" href="../reuso/header.css">
  <link rel="stylesheet" href="../reuso/footer.css">
  <link rel="stylesheet" href="../estilos/usuario.css">
  <style>
  body {
      background-color: #121212;
      color: #fff;
      font-family: 'Inter', sans-serif;
  }

  .contenido-usuario {
      padding: 2rem;
      text-align: center;
  }

  .tarjetas-usuario {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
  }

  .tarjeta-opcion {
      background-color: #1f1f1f;
      padding: 1.2rem 1rem;
      border-radius: 10px;
      color: #fff;
      text-decoration: none;
      box-shadow: 0 0 10px rgba(255,255,255,0.04);
      transition: transform 0.2s ease;
      font-size: 0.88rem;
  }

  .tarjeta-opcion:hover {
      background-color: #292929;
      transform: scale(1.02);
  }

  .tarjeta-opcion h3 {
      margin: 0 0 0.4rem;
      font-size: 1.1rem;
      color: #9be2ff;
  }

  .tarjeta-opcion p {
      margin: 0.3rem 0;
      color: #ccc;
      font-size: 0.84rem;
  }

  .tarjeta-opcion form {
      margin-top: 0.8rem;
  }

  .tarjeta-opcion button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 0.4rem 1rem;
      font-size: 0.8rem;
      border-radius: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
  }

  .tarjeta-opcion button:hover {
      background-color: #0056b3;
  }
  </style>
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
    <h1>Vacantes Disponibles</h1>
    <div class="tarjetas-usuario">
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($vacante = $resultado->fetch_assoc()): ?>
                <div class="tarjeta-opcion">
                    <h3><?php echo htmlspecialchars($vacante['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($vacante['descripcion']); ?></p>
                    <p><strong>Sueldo:</strong> $<?php echo number_format($vacante['criterio_10']); ?> MXN</p>
                    <form action="postularse.php" method="POST">
                        <input type="hidden" name="id_vacante" value="<?php echo $vacante['id']; ?>">
                        <button type="submit">Aplicar</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay vacantes disponibles por ahora.</p>
        <?php endif; ?>
    </div>
</main>

<footer class="pie-pagina">
    <div class="footer-contenido">
        <!-- Tu footer completo aquí como lo tienes en header/footer.css -->
    </div>
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
