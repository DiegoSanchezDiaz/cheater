<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6e6e6;
            color: #4f2c80;
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* VOLVER */
        .btn-volver {
            background-color: #6639a6;
            color: #ffffff;
            border: none;
        }
        .btn-volver:hover {
            background-color: #9b75d0;
            color: #ffffff;
        }
        
        /* ENVIAR */
        #submitBtn {
            background-color: #6639a6;
            border-color: #6639a6;
            margin: 80px;
        }
        #submitBtn:hover {
            background-color: #9b75d0;
            border-color: #9b75d0;
        }

        /* AÑADIR */
        #añadir {
            background-color: #6639a6;
            border-color: #6639a6;
            margin: 80px;
        }
        #añadir:hover {
            background-color: #9b75d0;
            border-color: #9b75d0;
        }
    </style>
</head>
<body>
    <a href="restaurantes.php" class="btn btn-volver mt-4">Volver</a>';

    <div class="container mt-5">
        <h1 class="mb-4">Productos y Valores Nutricionales</h1>
        <form id="productForm" action="mostrarDatos.php" method="post"> <!-- Cambiado action a mostrarDatos.php y method a post -->
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
                
                // Obtener el id_cadena desde la URL
                $id_cadena = $_GET['id'] ?? null;
                
                // Consulta SQL para obtener los productos filtrados por id_cadena
                if ($id_cadena !== null) {
                    $sql = "SELECT Productos.id, Productos.nombre, ValoresNutricionales.proteinas, ValoresNutricionales.carbohidratos, ValoresNutricionales.grasas, ValoresNutricionales.calorias
                            FROM Productos
                            JOIN ValoresNutricionales ON Productos.id = ValoresNutricionales.id_producto
                            WHERE Productos.id_cadena = $id_cadena";
                } else {
                    echo "No se ha proporcionado un id válido.";
                    exit; // Terminar la ejecución si no hay un id válido
                }
                
                // Ejecutar la consulta y obtener el resultado
                $result = $conn->query($sql);
                
                // Verificar si hay resultados y mostrar los productos y sus valores nutricionales
                if ($result->num_rows > 0) {
                    echo '<table id="productTable" class="table table-striped">'; // Añadido id="productTable"
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col"><input type="checkbox" id="selectAll"></th>';
                    echo '<th scope="col">Producto</th>';
                    echo '<th scope="col">Proteínas (g)</th>';
                    echo '<th scope="col">Carbohidratos (g)</th>';
                    echo '<th scope="col">Grasas (g)</th>';
                    echo '<th scope="col">Calorías (kcal)</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    while($row = $result->fetch_assoc()) {
                        echo '<tr id="productRow">'; // Añadido id="productRow"
                        echo '<td><input type="checkbox" name="selectedProducts[]" value="' . $row["id"] . '"></td>';
                        echo '<td>' . $row["nombre"] . '</td>';
                        echo '<td>' . $row["proteinas"] . '</td>';
                        echo '<td>' . $row["carbohidratos"] . '</td>';
                        echo '<td>' . $row["grasas"] . '</td>';
                        echo '<td>' . $row["calorias"] . '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No se encontraron productos para este restaurante.</p>';
                }
                
                // Cerrar conexión
                $conn->close();      
            ?>
            <input type="hidden" name="id_cadena" value="<?php echo $id_cadena; ?>"> <!-- Campo oculto para enviar id_cadena -->
            <a href="añadirProducto.php" class="btn btn-primary" id="añadir">Añadir productos</a>
            <button type="button" class="btn btn-primary" id="submitBtn">Procesar Selección</button> <!-- Cambiado type a button y añadido id="submitBtn" -->
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Script para seleccionar/deseleccionar todos los checkboxes
        document.getElementById('selectAll').addEventListener('click', function(event) {
            var checkboxes = document.querySelectorAll('input[name="selectedProducts[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
        });

        // Script para manejar el envío del formulario
        document.getElementById('submitBtn').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('input[name="selectedProducts[]"]:checked');
            var selectedProductIds = [];
            checkboxes.forEach(checkbox => {
                selectedProductIds.push(checkbox.value);
            });
            // Crear un campo hidden para enviar los productos seleccionados
            var hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'selectedProductIds';
            hiddenField.value = selectedProductIds.join(',');
            // Agregar el campo al formulario
            document.getElementById('productForm').appendChild(hiddenField);
            // Enviar el formulario
            document.getElementById('productForm').submit();
        });
    </script>
</body>
</html>