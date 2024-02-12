<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los datos de la tabla Proveedor
    $query = $conn->query('SELECT * FROM proveedor');
    $proveedores = $query->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="proveedor.html">&lt; Volver al Menú</a>
            <h2>Lista de Todos los Proveedores</h2>
        </header>

        <table>
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre Proveedor</th>
                    <th>Contacto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor) : ?>
                    <tr>
                        <td><?= $proveedor['id_prov'] ?></td>
                        <td><?= $proveedor['nom_prov'] ?></td>
                        <td><?= $proveedor['contacto'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
