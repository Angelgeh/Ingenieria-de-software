<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los datos de la tabla Venta
    $query = $conn->query('SELECT * FROM Venta');
    $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
    <link rel="stylesheet" href="stilos1.css">
    <link rel="stylesheet" href="stilos.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="venta.html">&lt; Volver al Menú</a>
            <h2>Lista de Todas las Ventas</h2>
        </header>

        <table>
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>ID Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta) : ?>
                    <tr>
                        <td><?= $venta['id_ven'] ?></td>
                        <td><?= $venta['id_cli'] ?></td>
                        <td><?= $venta['fecha'] ?></td>
                        <td><?= $venta['total'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
