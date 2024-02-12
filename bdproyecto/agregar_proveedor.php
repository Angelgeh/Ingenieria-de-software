<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_prov = $_POST['id_prov'];
        $nom_prov = $_POST['nom_prov'];
        $contacto = $_POST['contacto'];

        $sql = "INSERT INTO proveedor (id_prov, nom_prov, contacto) VALUES (:id_prov, :nom_prov, :contacto)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_prov', $id_prov);
        $stmt->bindParam(':nom_prov', $nom_prov);
        $stmt->bindParam(':contacto', $contacto);
        $stmt->execute();

        echo "Proveedor agregado correctamente";
    } else {
        echo "Error al procesar la solicitud";
    }
} catch(PDOException $e) {
    echo "Error al agregar proveedor: " . $e->getMessage();
}

$conn = null;
?>
