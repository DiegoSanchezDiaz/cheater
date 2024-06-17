<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #e6e6e6;
            color: #4f2c80;
            font-family: 'Raleway', sans-serif;
            text-align: center;
            padding: 50px;
        }
        form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
            max-width: 400px;
            width: 100%;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 1em;
        }
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #7f4fc3;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #4f2c80;
        }
        #mensaje {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form action="loginFunc.php" method="post">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <div>
        <p>¿No tienes cuenta? <a href="registro.php">Registrate</a></p> 
    </div>

    <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<p id='mensaje'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']); // Borrar el mensaje después de mostrarlo
        }
    ?>
</body>
</html>