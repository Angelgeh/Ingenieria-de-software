<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id_ven'])) {
        $id_ven = $_POST['id_ven'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM venta WHERE id_ven = :id_ven");
            $stmt->bindParam(':id_ven', $id_ven, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Venta eliminada correctamente.";
            } else {
                echo "No se encontró una venta con el ID proporcionado: " . $_POST['id_ven'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID de venta válido.";
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
        <a href="venta.html">&lt; Volver al Menú</a>
        <h1>Eliminar Venta</h1>
    </header>
    
    <form method="post">
        <label for="id_ven">ID de la Venta a Eliminar:</label>
        <input type="text" id="id_ven" name="id_ven">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
