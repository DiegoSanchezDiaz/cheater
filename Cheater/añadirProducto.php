<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto</title>
</head>
<body>
    <h2>Registrar Nuevo Producto</h2>
    <form action="procesarFormAñadirProd.php" method="POST">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="proteinas">Proteínas (g):</label>
        <input type="number" step="0.01" id="proteinas" name="proteinas" required><br><br>
        
        <label for="carbohidratos">Carbohidratos (g):</label>
        <input type="number" step="0.01" id="carbohidratos" name="carbohidratos" required><br><br>
        
        <label for="grasas">Grasas (g):</label>
        <input type="number" step="0.01" id="grasas" name="grasas" required><br><br>
        
        <label for="kcals">Calorías:</label>
        <input type="number" id="kcals" name="kcals" required><br><br>
        
        <label for="id_cadena">Cadena de Restaurantes:</label>
        <select id="id_cadena" name="id_cadena" required>
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

            // Obtener nombres e IDs de las cadenas de restaurantes
            $sql_cadenas = "SELECT id, nombre FROM restaurantes";
            $result_cadenas = $conn->query($sql_cadenas);

            // Cerrar conexión
            $conn->close();

            if ($result_cadenas->num_rows > 0) {
                while($row = $result_cadenas->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay cadenas disponibles</option>";
            }
            ?>
        </select><br><br>
        
        <input type="submit" value="Registrar Producto">
    </form>
</body>
</html>

        <!-- Comentario para subir a GIT-->