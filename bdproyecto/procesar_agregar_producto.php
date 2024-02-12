<!-- procesar_agregar_producto.php -->
<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

$dsn = "pgsql:host=$host;dbname=$dbname;user=$username;password=$password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    try {
        // Preparar la consulta para agregar un nuevo producto
        $query = $db->prepare("INSERT INTO producto (nom_prod, precio) VALUES (:nombre, :precio)");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':precio', $precio);
        $query->execute();
        
        // Redireccionar a la página de productos después de agregar
        header("Location: consultar_productos.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
