<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['buscar'])) {
        $busqueda = $_POST['buscar'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM producto WHERE nom_prod LIKE :busqueda");
            $busqueda = "%$busqueda%";
            $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h2>Resultados de la búsqueda:</h2>";
                echo "<div class='table-container'>";
                echo "<table class='styled-table'>";
                echo "<thead><tr><th>ID</th><th>Nombre</th><th>Precio</th></tr></thead>";
                echo "<tbody>";
            
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_prod'] . "</td>";
                    echo "<td>" . $row['nom_prod'] . "</td>";
                    echo "<td>" . $row['precio'] . "</td>";
                    echo "</tr>";
                }
            
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            
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
    <link rel="stylesheet" type="text/css" href="stilos.css">
    <link rel="stylesheet" href="stilosbusqueda.css">
    
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    <header>  
    <a href="producto.html">&lt; Volver al Menú</a>
    <h1>Búsqueda de Productos</h1>
    </header>
    <form method="post">
        <label for="buscar">Buscar producto:</label>
        <input type="text" id="buscar" name="buscar">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
