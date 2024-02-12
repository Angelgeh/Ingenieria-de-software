<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los datos de la tabla DetalleCompra
    $query = $conn->query('SELECT * FROM detallecompra');
    $detallesCompra = $query->fetchAll(PDO::FETCH_ASSOC);
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
            <h2>Lista de Detalles de Compras</h2>
        </header>

        <table>
            <thead>
                <tr>
                    <th>ID Detalle Compra</th>
                    <th>ID Compra</th>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detallesCompra as $detalle) : ?>
                    <tr>
                        <td><?= $detalle['id_det_com'] ?></td>
                        <td><?= $detalle['id_compra'] ?></td>
                        <td><?= $detalle['id_prod'] ?></td>
                        <td><?= $detalle['cantidad'] ?></td>
                        <td><?= $detalle['precio_unitario'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
