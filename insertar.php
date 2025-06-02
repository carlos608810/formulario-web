<?php

$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$bd = "formulario_web";


$conn = new mysqli($host, $usuario, $contrasena, $bd);


if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}


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