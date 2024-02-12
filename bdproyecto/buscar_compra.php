<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['buscar'])) {
        $busqueda = $_POST['buscar'];

        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';

        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM compra WHERE id_compra = :id_compra");
            $stmt->bindParam(':id_compra', $busqueda, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h2>Resultados de la búsqueda:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>ID Compra</th><th>ID Proveedor</th><th>Fecha</th><th>Total</th></tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_compra'] . "</td>";
                    echo "<td>" . $row['id_prov'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron resultados para el ID de compra: " . $_POST['buscar'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID de compra para realizar la búsqueda.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="stilosbusqueda.css">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    <header>  
        <a href="compra.html">&lt; Volver al Menú</a>
        <h1>Búsqueda de Compras por ID</h1>
    </header>
    <form method="post">
        <label for="buscar">Buscar por ID de compra:</label>
        <input type="text" id="buscar" name="buscar">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
