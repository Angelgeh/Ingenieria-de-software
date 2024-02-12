<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_prod = $_POST['id_prod'];
        $nom_prod = $_POST['nom_prod'];
        $precio = $_POST['precio'];

        $sql = "INSERT INTO Producto (id_prod, nom_prod, precio) VALUES (:id_prod, :nom_prod, :precio)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_prod', $id_prod);
        $stmt->bindParam(':nom_prod', $nom_prod);
        $stmt->bindParam(':precio', $precio);
        $stmt->execute();

        echo "Producto agregado correctamente";
    } else {
        echo "Error al procesar la solicitud";
    }
} catch(PDOException $e) {
    echo "Error al agregar producto: " . $e->getMessage();
}

$conn = null;
?>
