<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "formulario_web";

$conn = new mysqli($host, $usuario, $contrasena, $bd);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = floatval($_POST['precio']);
  $categoria = $_POST['categoria'];
  $marca = $_POST['marca'];
  $modelo = $_POST['modelo'];
  $stock = intval($_POST['stock']);
  $color = $_POST['color'];
  $tamaño = $_POST['tamaño'];
  $fecha = $_POST['fecha'];

  $carpeta = "imagenes/";
  if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
  }

  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $nombreImagen = basename($_FILES["imagen"]["name"]);
    $rutaImagen = $carpeta . uniqid() . "_" . $nombreImagen;

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
      $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, marca, modelo, stock, color, tamaño, fecha_ingreso, imagen)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssdsssissss", $nombre, $descripcion, $precio, $categoria, $marca, $modelo, $stock, $color, $tamaño, $fecha, $rutaImagen);

      if ($stmt->execute()) {
        echo "<h2>✅ Producto guardado correctamente.</h2><a href='index.html'>Volver</a>";
      } else {
        echo "<h2 style='color:red;'>❌ Error al guardar: " . $stmt->error . "</h2>";
      }
      $stmt->close();
    } else {
      echo "<h2 style='color:red;'>❌ Error al guardar la imagen en el servidor.</h2>";
    }
  } else {
    echo "<h2 style='color:red;'>❌ No se recibió la imagen.</h2>";
  }
  $conn->close();
}
?>