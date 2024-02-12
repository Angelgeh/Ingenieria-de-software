<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_ven = $_POST['id_ven'];
        $id_cli = $_POST['id_cli'];
        $fecha = $_POST['fecha'];
        $total = $_POST['total'];

        $query = $conn->prepare("INSERT INTO venta (id_ven, id_cli, fecha, total) VALUES (:id_ven, :id_cli, :fecha, :total)");
        $query->bindParam(':id_ven', $id_ven, PDO::PARAM_INT);
        $query->bindParam(':id_cli', $id_cli, PDO::PARAM_INT);
        $query->bindParam(':fecha', $fecha);
        $query->bindParam(':total', $total);

        $query->execute();

        echo "Cliente agregado correctamente a la venta con ID: $id_ven.";
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
    <title>Agregar Venta</title>
</head>
<body>
    <header>
        <a href="venta.html">&lt; Volver al Menú</a>
        <h1>Metales Herrera y Asociados S.A DE C.V</h1>
    </header>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_ven">ID Venta:</label>
        <input type="number" id="id_ven" name="id_ven" required>

        <label for="id_cli">ID Cliente:</label>
        <input type="number" id="id_cli" name="id_cli" required>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="total">Total:</label>
        <input type="number" id="total" name="total" step="0.01" required>

        <input type="submit" value="Agregar Cliente a Venta">
    </form>
</body>
</html>
