<!-- consultar_productos.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Consultar Productos</h1>
    </header>

    <?php
    $host = 'localhost';
    $dbname = 'proyecto';
    $username = 'postgres';
    $password = 'Anmeca130923';
    
    $dsn = "pgsql:host=$host;dbname=$dbname;user=$username;password=$password";

    try {
        $query = $db->query("SELECT * FROM producto");
        $productos = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($productos) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Precio</th></tr>";
            foreach ($productos as $producto) {
                echo "<tr>";
                echo "<td>" . $producto['id_prod'] . "</td>";
                echo "<td>" . $producto['nom_prod'] . "</td>";
                echo "<td>" . $producto['precio'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay productos disponibles.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <footer>
        <p>&copy; 2023 Tu Empresa</p>
    </footer>
</body>
</html>
