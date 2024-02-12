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

            $stmt = $conn->prepare("SELECT * FROM cliente WHERE nom_cli LIKE :busqueda OR correo LIKE :busqueda OR telefono LIKE :busqueda");
            $busqueda = "%$busqueda%";
            $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h2>Resultados de la búsqueda:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th></tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_cli'] . "</td>";
                    echo "<td>" . $row['nom_cli'] . "</td>";
                    echo "<td>" . $row['correo'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron resultados para: " . $_POST['buscar'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un término de búsqueda válido.";
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
        <a href="cliente.html">&lt; Volver al Menú</a>
        <h1>Búsqueda de Clientes</h1>
    </header>
    <form method="post">
        <label for="buscar">Buscar cliente:</label>
        <input type="text" id="buscar" name="buscar">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
