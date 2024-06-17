<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // Cambiar si es necesario
$username = "root";
$password = "";
$dbname = "cheater";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$proteinas = $_POST['proteinas'];
$carbohidratos = $_POST['carbohidratos'];
$grasas = $_POST['grasas'];
$kcals = $_POST['kcals'];
$id_cadena = $_POST['id_cadena'];

// Llamar al procedimiento almacenado
$stmt = $conn->prepare("CALL InsertarProductoYValores(?, ?, ?, ?, ?, ?)"); //Stored procedure
$stmt->bind_param("siddid", $nombre, $id_cadena, $proteinas, $carbohidratos, $grasas, $kcals);

if ($stmt->execute()) {
    echo "Producto registrado con éxito.";
} else {
    echo "Error al registrar el producto: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
