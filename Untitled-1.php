<?php
// Datos de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Dejar vacío si usas XAMPP o Laragon por defecto
$bd = "formulario_web";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $bd);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$stock = $_POST['stock'];
$color = $_POST['color'];
$tamaño = $_POST['tamaño'];
$fecha = $_POST['fecha'];

// Preparar y ejecutar la consulta
$sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, marca, modelo, stock, color, tamaño, fecha_ingreso)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsssisss", $nombre, $descripcion, $precio, $categoria, $marca, $modelo, $stock, $color, $tamaño, $fecha);

if ($stmt->execute()) {
  echo "Producto guardado correctamente.";
} else {
  echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>