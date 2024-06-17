<?php
    session_start(); // Iniciar la sesión para utilizar variables de sesión

    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = ""; // Ajusta según tu configuración
    $dbname = "cheater";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Verificar si el correo ya existe
    $checkEmail = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $checkEmail->bind_param("s", $correo);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        // Si el correo ya existe
        $_SESSION['message'] = "El correo ya está registrado. Por favor, utiliza otro correo.";
    } else {
        // Si el correo no existe, proceder con el registro
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, correo, contraseña) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usuario, $correo, $contraseña);

        if ($stmt->execute()) {
            // Redirigir a la página de inicio después de un registro exitoso
            header("Location: home.php");
            exit(); // Asegurarse de que el script se detenga después de la redirección
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Cerrar la conexión
    $checkEmail->close();
    $conn->close();

    // Redirigir de vuelta al formulario
    header("Location: registro.php");
    exit();
?>
