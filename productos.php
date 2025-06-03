<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "formulario_web";

$conn = new mysqli($host, $usuario, $contrasena, $bd);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM productos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }
    h1 {
      text-align: center;
    }
    .productos {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }
    .producto {
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 220px;
      padding: 15px;
      text-align: center;
    }
    .producto img {
      max-width: 100%;
      border-radius: 6px;
    }
    .descripcion {
      margin-top: 10px;
      font-size: 14px;
      color: #333;
    }
  </style>
</head>
<body>

<h1>Productos Guardados</h1>
<div class="productos">
  <?php while ($row = $resultado->fetch_assoc()) : ?>
    <div class="producto">
      <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="<?= htmlspecialchars($row['nombre']) ?>">
      <div class="descripcion">
        <strong><?= htmlspecialchars($row['nombre']) ?></strong><br>
        <?= htmlspecialchars($row['descripcion']) ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>