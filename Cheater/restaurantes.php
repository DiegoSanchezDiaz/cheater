<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes</title>
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
        #header {
            background-color: #6639a6;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #header img {
            max-width: 100px;
        }
        #menu {
            display: flex;
        }
        #menu a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1em;
            margin-left: 20px;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }
        #menu a:hover {
            background-color: #4f2c80;
            border-radius: 5px;
        }
        #contenido {
            padding: 50px 20px;
        }
        .carta {
            text-decoration: none;
            color: inherit;
        }
        .carta img {
            max-width: 100%;
            height: 250px;
            border-bottom: 1px solid #e6e6e6;
        }
        .carta .card-body {
            background-color: #ffffff;
            padding: 15px;
        }
        .carta .card-title {
            font-size: 1.5em;
            color: #4f2c80;
        }
        .carta:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        /* FOOTER */
        #footer {
            margin-top: 100px;
            background-color: #6639a6;
            color: #ffffff;
            padding: 20px 0;
        }
        #footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #footer a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }
        #footer a:hover {
            color: #7f4fc3;
        }
    </style>
</head>
<body>
    <div id="header">
        <img src="Logo1.png" alt="Logo">
        <nav id="menu">
            <a href="home.php">Inicio</a>
            <a href="restaurantes.php">Restaurantes</a>
            <a href="">ChatBot</a>
            <a href="inicioSesion.php">Cerrar sesión</a>
        </nav>
    </div>
    <div id="contenido">
        <div class="container mt-5">
            <div class="row">
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
                    
                    // Consulta SQL para obtener los nombres de los restaurantes, sus imágenes y sus identificadores
                    $sql = "SELECT id, nombre, imagen FROM restaurantes";

                    
                    // Ejecutar la consulta y obtener el resultado
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-4">';
                            echo '<a href="mostrarProductos.php?id=' . urlencode($row["id"]) . '" class="card mb-4 carta">';
                            if (!empty($row["imagen"])) {
                                echo '<img src="../img/' . $row["imagen"] . '" alt="' . $row["nombre"] . '">';
                            }
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $row["nombre"] . '</h5>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "No se encontraron restaurantes.";
                    }
                    
                    
                    // Cerrar conexión
                    $conn->close();      
                ?>
            </div>
        </div>
    </div>

    <div id="footer">
        <div class="container">
            <div>
                <p>Correo electrónico: <a href="mailto:cheater@info.es" style="color: #ffffff;">cheater@info.es</a></p>
            </div>
            <div>
                <a href="#">Política de privacidad</a>
                <a href="#">Aviso legal</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>