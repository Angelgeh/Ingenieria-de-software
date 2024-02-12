<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

$dsn = "pgsql:host=$host;dbname=$dbname;user=$username;password=$password";

try {
    $db = new PDO($dsn);
    // Establecer el modo de error PDO a excepción
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Obtener el nombre de la tabla desde la URL
$tabla = isset($_GET['tabla']) ? $_GET['tabla'] : '';

// Consulta a la base de datos para obtener la estructura de la tabla
if (!empty($tabla)) {
    try {
        $query = $db->prepare("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = :tabla");
        $query->bindParam(':tabla', $tabla, PDO::PARAM_STR);
        $query->execute();
        $estructuraTabla = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Detalle de Tabla</title>
</head>
<body>
    <header>
        <h1>Detalle de Tabla</h1>
    </header>

    <nav>
        <a href="index.html">Volver al Menú</a>
    </nav>

    <section>
        <?php if (!empty($estructuraTabla)): ?>
            <h2>Estructura de la Tabla <?php echo $tabla; ?></h2>
            <table>
                <tr>
                    <th>Columna</th>
                    <th>Tipo de Dato</th>
                </tr>
                <?php foreach ($estructuraTabla as $columna): ?>
                    <tr>
                        <td><?php echo $columna['column_name']; ?></td>
                        <td><?php echo $columna['data_type']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No se ha especificado una tabla válida.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2023 Tu Empresa</p>
    </footer>
</body>
</html>
