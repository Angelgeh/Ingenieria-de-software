<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los datos de la tabla Compra
    $query = $conn->query('SELECT * FROM compra');
    $compras = $query->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="compra.html">&lt; Volver al Menú</a>
            <h2>Lista de Todas las Compras</h2>
        </header>

        <table>
            <thead>
                <tr>
                    <th>ID Compra</th>
                    <th>ID Proveedor</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $compra) : ?>
                    <tr>
                        <td><?= $compra['id_compra'] ?></td>
                        <td><?= $compra['id_prov'] ?></td>
                        <td><?= $compra['fecha'] ?></td>
                        <td><?= $compra['total'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
