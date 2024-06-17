<?php
    session_start(); // Iniciar la sesión para utilizar variables de sesión

    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = ""; // Ajusta según tu configuración
    $dbname = "cheater";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $username = $result->fetch_assoc();
            if (password_verify($contraseña, $username['contraseña'])) {
                header("Location: home.php");
                exit;
            } else {
                $_SESSION['message'] = "Correo o contraseña incorrectos.";
                header("Location: inicioSesion.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Correo o contraseña incorrectos.";
            header("Location: inicioSesion.php");
            exit;
        }
    }
?>