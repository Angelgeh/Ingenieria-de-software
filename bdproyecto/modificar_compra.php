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
        $campo = $_POST['campo'];
        $nuevo_valor = $_POST['nuevo_valor'];

        $query = $conn->prepare("UPDATE compra SET $campo = :nuevo_valor WHERE id_compra = :id_compra");

        if ($campo === 'id_prov' || $campo === 'fecha' || $campo === 'total') {
            $query->bindParam(':nuevo_valor', $nuevo_valor);
        } else {
            echo "Campo inválido.";
            exit();
        }

        $query->bindParam(':id_compra', $id_compra);
        $query->execute();

        echo "El campo '$campo' de la compra con ID $id_compra se actualizó correctamente.";
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
        <a href="compra.html">&lt; Volver al Menú</a>
        <h1>Actualizar Campo de la Compra</h1>
    </header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_compra">ID de la Compra:</label>
        <input type="number" id="id_compra" name="id_compra" required>

        <label for="campo">Campo a Actualizar:</label>
        <select id="campo" name="campo">
            <option value="id_prov">ID Proveedor</option>
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
