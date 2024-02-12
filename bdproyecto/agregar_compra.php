<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_compra = $_POST['id_compra'];
        $id_prov = $_POST['id_prov'];
        $fecha = $_POST['fecha'];
        $total = $_POST['total'];

        $query = $conn->prepare("INSERT INTO compra (id_compra, id_prov, fecha, total) VALUES (:id_compra, :id_prov, :fecha, :total)");
        $query->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
        $query->bindParam(':id_prov', $id_prov, PDO::PARAM_INT);
        $query->bindParam(':fecha', $fecha);
        $query->bindParam(':total', $total);

        $query->execute();

        echo "Proveedor agregado correctamente a la compra con ID: $id_compra.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stilos.css">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    <header>
        <a href="compra.html">&lt; Volver al Menú</a>
        <h1>Agregar Compra</h1>
    </header>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_compra">ID Compra:</label>
        <input type="number" id="id_compra" name="id_compra" required>

        <label for="id_prov">ID Proveedor:</label>
        <input type="number" id="id_prov" name="id_prov" required>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="total">Total:</label>
        <input type="number" id="total" name="total" step="0.01" required>

        <input type="submit" value="Agregar Proveedor a Compra">
    </form>
</body>
</html>
