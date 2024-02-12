<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['buscar'])) {
        $busqueda = $_POST['buscar'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $username = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM empleado WHERE nom_emp LIKE :busqueda OR puesto_emp LIKE :busqueda");
            $busqueda = "%$busqueda%";
            $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h2>Resultados de la búsqueda:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Puesto</th></tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_emp'] . "</td>";
                    echo "<td>" . $row['nom_emp'] . "</td>";
                    echo "<td>" . $row['puesto_emp'] . "</td>";
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
        <a href="empleado.html">&lt; Volver al Menú</a>
        <h1>Búsqueda de Empleados</h1>
    </header>
    <form method="post">
        <label for="buscar">Buscar empleado:</label>
        <input type="text" id="buscar" name="buscar">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
