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
        $campo = $_POST['campo'];
        $nuevo_valor = $_POST['nuevo_valor'];

        $query = $conn->prepare("UPDATE Venta SET $campo = :nuevo_valor WHERE id_ven = :id_ven");

        if ($campo === 'id_cli' || $campo === 'fecha' || $campo === 'total') {
            $query->bindParam(':nuevo_valor', $nuevo_valor);
        } else {
            echo "Campo inválido.";
            exit();
        }

        $query->bindParam(':id_ven', $id_ven);
        $query->execute();

        echo "El campo '$campo' de la venta con ID $id_ven se actualizó correctamente.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stilosbusqueda.css">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    <header>
        <a href="venta.html">&lt; Volver al Menú</a>
        <h1>Actualizar Campo de la Venta</h1>
    </header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_ven">ID de la Venta:</label>
        <input type="number" id="id_ven" name="id_ven" required>

        <label for="campo">Campo a Actualizar:</label>
        <select id="campo" name="campo">
            <option value="id_cli">ID Cliente</option>
            <option value="fecha">Fecha</option>
            <option value="total">Total</option>
            <!-- Si también quieres permitir actualizar otros campos, agrega las opciones correspondientes -->
        </select>

        <label for="nuevo_valor">Nuevo Valor:</label>
        <input type="text" id="nuevo_valor" name="nuevo_valor" required>

        <input type="submit" value="Actualizar Campo">
    </form>
</body>
</html>
