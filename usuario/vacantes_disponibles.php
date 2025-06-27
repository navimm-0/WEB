<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../scripts/conexion.php');

<<<<<<< HEAD
$sql = "SELECT * FROM Vacante WHERE estado = 'activa' ORDER BY fecha_creacion DESC";
=======
// Verifica que el usuario haya iniciado sesión como usuario
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: ../index.php");
    exit();
}

// Obtener vacantes
$sql = "SELECT * FROM Vacante ORDER BY titulo ASC";
>>>>>>> e7c47b1f3d11f396ac1190e95eb0b0f41148e08e
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<<<<<<< HEAD
    <meta charset="UTF-8">
    <title>Vacantes Disponibles – GG Records</title>
    <link rel="stylesheet" href="../reuso/header.css">
    <link rel="stylesheet" href="../reuso/footer.css">
    <link rel="stylesheet" href="../estilos/vacantes.css">
=======
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
>>>>>>> e7c47b1f3d11f396ac1190e95eb0b0f41148e08e
</head>
<body>

<header class="barra-superior" style="font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;">
    <div class="contenedor-header">
        <div class="logo-area">
            <span class="gg">GG</span><span class="records">RECORDS</span>
        </div>
        <nav class="nav-header">
            <a href="../index.php">Inicio</a>
            <a href="menu_usuario.php">Menú Usuario</a>
            <a href="perfil.php">Perfil</a>
            <a href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="contenido-usuario">
<<<<<<< HEAD
    <h1>Vacantes Disponibles</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <div class="vacantes-lista">
            <?php while ($fila = $resultado->fetch_assoc()): ?>
               <!-- ...dentro del while ($fila = $resultado->fetch_assoc()) -->
<div class="vacante-card">
    <h2><?php echo htmlspecialchars($fila['titulo']); ?></h2>
    <p><?php echo htmlspecialchars($fila['descripcion']); ?></p>
    <ul>
        <li><strong>Nivel académico:</strong> <?php echo htmlspecialchars($fila['criterio_1']); ?></li>
        <li><strong>Software requerido:</strong> <?php echo htmlspecialchars($fila['criterio_2']); ?></li>
        <li><strong>Años de experiencia:</strong> <?php echo htmlspecialchars($fila['criterio_3']); ?></li>
        <li><strong>Edad mínima:</strong> <?php echo htmlspecialchars($fila['criterio_9']); ?></li>
        <li><strong>Sueldo mensual:</strong> $<?php echo number_format($fila['criterio_10'], 2); ?> MXN</li>
    </ul>
    <a href="aplicar_vacante.php?id=<?php echo $fila['id']; ?>" class="boton">Aplicar</a>
</div>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay vacantes disponibles en este momento.</p>
    <?php endif; ?>
</main>

<footer class="pie-pagina">
    <?php include '../reuso/footer.php'; ?>
=======
<<<<<<< HEAD
  <h1>Vacantes Disponibles</h1>
  <div class="tarjetas-usuario">
    <?php if ($resultado->num_rows > 0): ?>
        <?php while($fila = $resultado->fetch_assoc()): ?>
            <div class="tarjeta-opcion">
                <h3><?php echo htmlspecialchars($fila['titulo']); ?></h3>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($fila['descripcion']); ?></p>
                <p><strong>Sueldo mensual:</strong> $<?php echo number_format($fila['criterio_10'], 2); ?></p>
               <form action="subir_cv.php" method="POST">
    <input type="hidden" name="id_vacante" value="<?php echo $fila['id']; ?>">
    <button type="submit">Aplicar</button>
</form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay vacantes disponibles en este momento.</p>
    <?php endif; ?>
  </div>
=======
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
>>>>>>> 49b55cd16b514c4f277259c395095ac1668e3789
</main>

<footer class="pie-pagina">
    <div class="footer-contenido">
<<<<<<< HEAD

=======
        <!-- Tu footer completo aquí como lo tienes en header/footer.css -->
>>>>>>> 49b55cd16b514c4f277259c395095ac1668e3789
    </div>
    <div class="footer-copy">
        <p>© 2025 GG Records – Todos los derechos reservados.</p>
    </div>
>>>>>>> e7c47b1f3d11f396ac1190e95eb0b0f41148e08e
</footer>
</body>
</html>
