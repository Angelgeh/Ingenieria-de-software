<?php
session_start();

// Datos de conexión a PostgreSQL
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

// Intentar conectar a la base de datos
try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para buscar al usuario en la tabla 'usuario'
    $stmt = $conn->prepare("SELECT usuario_usuario, usuario_clave FROM usuario WHERE usuario_usuario = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verificar la contraseña
        if (password_verify($password, $user['usuario_clave'])) {
            // Iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php'); // Redirigir al panel de control
            exit;
        } else {
            echo 'Usuario o contraseña incorrectos';
        }
    } else {
        echo 'Usuario o contraseña incorrectos';
    }
}

$conn = null; // Cerrar la conexión
?>

