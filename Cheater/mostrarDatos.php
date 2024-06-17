<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valores Nutricionales</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Estilos personalizados */
    body {
        background-color: #e6e6e6;
        color: #4f2c80;
        font-family: 'Raleway', sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    #titulo {
        color: #6639a6;
        text-align: center;
    }
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #6639a6;
        color: white;
    }
    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .mt-5 {
        margin-top: 30px;
    }
    /* Estilo para el botón de volver */
    .btn-volver {
        background-color: #6639a6;
        color: #ffffff;
        border: none;
    }
    .btn-volver:hover {
        background-color: #9b75d0;
        color: #ffffff;
    }
</style>
</head>
<body>
    <div class="container mt-5">
        <h1 id="titulo" class="mb-4">Productos y Valores Nutricionales Seleccionados</h1>
        
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
            
            // Obtener el id_cadena y los IDs de productos seleccionados
            $id_cadena = $_POST['id_cadena'] ?? null;
            $selectedProductIds = $_POST['selectedProductIds'] ?? '';

            // Convertir los IDs a un array
            $selectedIdsArray = explode(',', $selectedProductIds);

            // Consulta SQL para obtener los detalles de los productos seleccionados
            $sql = "SELECT Productos.nombre, ValoresNutricionales.proteinas, ValoresNutricionales.carbohidratos, ValoresNutricionales.grasas, ValoresNutricionales.calorias
                    FROM Productos
                    JOIN ValoresNutricionales ON Productos.id = ValoresNutricionales.id_producto
                    WHERE Productos.id_cadena = $id_cadena
                    AND Productos.id IN (" . implode(',', $selectedIdsArray) . ")";

            // Ejecutar la consulta y obtener el resultado
            $result = $conn->query($sql);

            // Variables para las sumas totales
            $totalProteinas = 0;
            $totalCarbohidratos = 0;
            $totalGrasas = 0;
            $totalCalorias = 0;

            // Verificar si hay resultados y mostrar los productos y sus valores nutricionales
            if ($result->num_rows > 0) {
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Producto</th>';
                echo '<th scope="col">Proteínas (g)</th>';
                echo '<th scope="col">Carbohidratos (g)</th>';
                echo '<th scope="col">Grasas (g)</th>';
                echo '<th scope="col">Calorías (kcal)</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Iterar sobre los productos seleccionados
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["nombre"] . '</td>';
                    echo '<td>' . $row["proteinas"] . '</td>';
                    echo '<td>' . $row["carbohidratos"] . '</td>';
                    echo '<td>' . $row["grasas"] . '</td>';
                    echo '<td>' . $row["calorias"] . '</td>';
                    echo '</tr>';

                    // Sumar los valores nutricionales
                    $totalProteinas += $row["proteinas"];
                    $totalCarbohidratos += $row["carbohidratos"];
                    $totalGrasas += $row["grasas"];
                    $totalCalorias += $row["calorias"];
                }

                // Mostrar las sumas totales al final de la tabla
                echo '<tr>';
                echo '<th>Total</th>';
                echo '<td>' . $totalProteinas . '</td>';
                echo '<td>' . $totalCarbohidratos . '</td>';
                echo '<td>' . $totalGrasas . '</td>';
                echo '<td>' . $totalCalorias . '</td>';
                echo '</tr>';

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No se encontraron productos seleccionados.</p>';
            }

            // Consulta SQL para obtener los datos de ejercicios (calorías por kilómetro)
            $sql_ejercicios = "SELECT ejercicio, calorias_por_km FROM ejercicios";
            $result_ejercicios = $conn->query($sql_ejercicios);

            // Calcular equivalencias
            $calorias_por_km_correr = 0;
            $calorias_por_km_caminar = 0;
            $calorias_por_km_bicicleta = 0;

            if ($result_ejercicios->num_rows > 0) {
                while($row = $result_ejercicios->fetch_assoc()) {
                    if ($row["ejercicio"] == "correr") {
                        $calorias_por_km_correr = $row["calorias_por_km"];
                    } elseif ($row["ejercicio"] == "caminar") {
                        $calorias_por_km_caminar = $row["calorias_por_km"];
                    } elseif ($row["ejercicio"] == "bicicleta") {
                        $calorias_por_km_bicicleta = $row["calorias_por_km"];
                    }
                }
            }

            // Calcular los kilómetros equivalentes
            $km_corriendo = $totalCalorias / $calorias_por_km_correr;
            $km_caminando = $totalCalorias / $calorias_por_km_caminar;
            $km_bicicleta = $totalCalorias / $calorias_por_km_bicicleta;

            echo '<h3 class="mt-5">Comparativa de Calorías Quemadas</h3>';
            echo '<p><strong>' . number_format($totalCalorias, 2) . '</strong> calorías equivalen a:</p>';
            echo '<ul id="comparativa">';
            echo '<li><strong>' . number_format($km_corriendo, 2) . '</strong> kilómetros corriendo</li>';
            echo '<li><strong>' . number_format($km_caminando, 2) . '</strong> kilómetros caminando</li>';
            echo '<li><strong>' . number_format($km_bicicleta, 2) . '</strong> kilómetros en bicicleta</li>';
            echo '</ul>';

            // Botón de volver con clase personalizada
            echo '<a href="restaurantes.php" class="btn btn-volver mt-4">Volver</a>';

            // Cerrar conexión
            $conn->close();      
        ?>
    </div>
</body>
</html>