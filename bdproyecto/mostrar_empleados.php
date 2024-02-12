<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los datos de la tabla Empleado
    $query = $conn->query('SELECT * FROM empleado');
    $empleados = $query->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="empleado.html">&lt; Volver al Menú</a>
            <h2>Lista de Todos los Empleados</h2>
        </header>

        <table>
            <thead>
                <tr>
                    <th>ID Empleado</th>
                    <th>Nombre Empleado</th>
                    <th>Puesto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado) : ?>
                    <tr>
                        <td><?= $empleado['id_emp'] ?></td>
                        <td><?= $empleado['nom_emp'] ?></td>
                        <td><?= $empleado['puesto_emp'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
