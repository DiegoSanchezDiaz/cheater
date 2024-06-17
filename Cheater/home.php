<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        /* MENU */
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

        /* CONTENIDO */
        #contenido {
            padding: 50px 20px;
        }
        .bienvenida {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            max-width: 800px;
            padding: 30px;
            text-align: left;
            width: 100%;
        }
        .bienvenida h1 {
            color: #7f4fc3;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .bienvenida p {
            color: #4f2c80;
            font-size: 1.2em;
            line-height: 1.6;
        }

        /* IMG/TEXTO */
        #info {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
            overflow: hidden;
            display: flex;
            margin-bottom: 100px;
        }
        #info img {
            flex: 0 0 auto;
            max-width: 50%;
            height: auto;
            border-radius: 8px 0 0 8px;
            padding: 30px;
        }
        #info p {
            flex: 0 0 50%;
            color: #4f2c80;
            font-size: 1.2em;
            line-height: 1.6;
            padding: 20px;
        }

        /* BOTON */
        #boton .btn-primary {
            background-color: #6639a6;
            border-color: #6639a6;
        }

        #boton .btn-primary:hover {
            background-color: #9b74d0;
            border-color: #9b74d0;
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
        <div class="bienvenida">
            <h1>Bienvenido a CHEATER</h1>
            <p>Esta es tu plataforma para alcanzar tus objetivos. Aquí podrás encontrar los mejores recursos y apoyo para maximizar tu potencial. Estamos comprometidos en proporcionarte las herramientas necesarias para tu éxito.</p>
        </div>
    </div>

    <div id="info" class="d-flex align-items-center">
        <img src="food.jpg" alt="img1">
        <p>La sociedad actual está cada vez más centrada en la salud, la nutrición y la estética. Existe una fuerte demanda de 
            alimentos saludables, programas de ejercicio y tratamientos estéticos. La aplicación Cheater ayuda a disfrutar de 
            días de indulgencia como el "cheat day" de manera controlada, siendo un aliado en la búsqueda de un estilo de vida 
            equilibrado y saludable.</p>
    </div>

    <div id="boton">
        <!-- Botón que redirige a restaurantes.php -->
        <a href="restaurantes.php" class="btn btn-primary mt-3">Ver Restaurantes</a>
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