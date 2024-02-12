<?php
// Datos de conexión a la base de datos (reemplaza con tus propios datos)
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    // Conexión a la base de datos
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se envió un formulario y agregar el nuevo cliente
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_cli = $_POST['id_cli'];
        $nom_cli = $_POST['nom_cli'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];

        // Consulta para insertar un nuevo cliente
        $query = $conn->prepare("INSERT INTO Cliente (id_cli, nom_cli, correo, telefono) VALUES (:id_cli, :nom_cli, :correo, :telefono)");
        $query->bindParam(':id_cli', $id_cli);
        $query->bindParam(':nom_cli', $nom_cli);
        $query->bindParam(':correo', $correo);
        $query->bindParam(':telefono', $telefono);
        $query->execute();

        echo "Nuevo cliente agregado correctamente.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
